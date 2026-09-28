<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\SpmbRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpmbController extends Controller
{
    public function __construct(
        protected SpmbRepository $spmbRepository
    ) {
    }

    public function index(): View
    {
        $spmbs = $this->spmbRepository->getAll();

        return view(
            'admin.spmb.index',
            compact('spmbs')
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'tanggal_mulai' => [
                'nullable',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'status' => [
                'required',
                'in:Dibuka,Belum Dibuka,Ditutup',
            ],

            'persyaratan' => [
                'nullable',
                'string',
            ],

            'alur_pendaftaran' => [
                'nullable',
                'string',
            ],

            'link_pendaftaran' => [
                'nullable',
                'url',
                'max:500',
            ],

            'kontak' => [
                'nullable',
                'string',
                'max:255',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('spmb', 'public');
        }

        $spmb = $this->spmbRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data SPMB berhasil ditambahkan.',
            'data' => $spmb,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $spmb = $this->spmbRepository->findById($id);

        if (!$spmb) {
            return response()->json([
                'success' => false,
                'message' => 'Data SPMB tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $spmb,
        ]);
    }

    public function update(
        Request $request,
        int $id
    ): JsonResponse {
        $spmb = $this->spmbRepository->findById($id);

        if (!$spmb) {
            return response()->json([
                'success' => false,
                'message' => 'Data SPMB tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'tanggal_mulai' => [
                'nullable',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'status' => [
                'required',
                'in:Dibuka,Belum Dibuka,Ditutup',
            ],

            'persyaratan' => [
                'nullable',
                'string',
            ],

            'alur_pendaftaran' => [
                'nullable',
                'string',
            ],

            'link_pendaftaran' => [
                'nullable',
                'url',
                'max:500',
            ],

            'kontak' => [
                'nullable',
                'string',
                'max:255',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('gambar')) {

            if (
                $spmb->gambar &&
                file_exists(
                    storage_path(
                        'app/public/' . $spmb->gambar
                    )
                )
            ) {
                unlink(
                    storage_path(
                        'app/public/' . $spmb->gambar
                    )
                );
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('spmb', 'public');

        } else {
            unset($validated['gambar']);
        }

        $updated = $this->spmbRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Data SPMB berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $spmb = $this->spmbRepository->findById($id);

        if (!$spmb) {
            return response()->json([
                'success' => false,
                'message' => 'Data SPMB tidak ditemukan.',
            ], 404);
        }

        if (
            $spmb->gambar &&
            file_exists(
                storage_path(
                    'app/public/' . $spmb->gambar
                )
            )
        ) {
            unlink(
                storage_path(
                    'app/public/' . $spmb->gambar
                )
            );
        }

        $this->spmbRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Data SPMB berhasil dihapus.',
        ]);
    }
}