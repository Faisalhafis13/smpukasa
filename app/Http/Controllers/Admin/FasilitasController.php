<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\FasilitasRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FasilitasController extends Controller
{
    public function __construct(
        protected FasilitasRepository $fasilitasRepository
    ) {
    }

    public function index(): View
    {
        $fasilitas = $this->fasilitasRepository->getAll();

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'kondisi' => ['nullable', 'string', 'max:100'],
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
                ->store('fasilitas', 'public');
        }

        $fasilitas = $this->fasilitasRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan.',
            'data' => $fasilitas,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $fasilitas = $this->fasilitasRepository->findById($id);

        if (!$fasilitas) {
            return response()->json([
                'success' => false,
                'message' => 'Data fasilitas tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $fasilitas,
        ]);
    }

    public function update(
        Request $request,
        int $id
    ): JsonResponse {
        $fasilitas = $this->fasilitasRepository->findById($id);

        if (!$fasilitas) {
            return response()->json([
                'success' => false,
                'message' => 'Data fasilitas tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'kondisi' => ['nullable', 'string', 'max:100'],
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('gambar')) {

            if (
                $fasilitas->gambar &&
                file_exists(
                    storage_path(
                        'app/public/' . $fasilitas->gambar
                    )
                )
            ) {
                unlink(
                    storage_path(
                        'app/public/' . $fasilitas->gambar
                    )
                );
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('fasilitas', 'public');
        } else {
            unset($validated['gambar']);
        }

        $updated = $this->fasilitasRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $fasilitas = $this->fasilitasRepository->findById($id);

        if (!$fasilitas) {
            return response()->json([
                'success' => false,
                'message' => 'Data fasilitas tidak ditemukan.',
            ], 404);
        }

        if (
            $fasilitas->gambar &&
            file_exists(
                storage_path(
                    'app/public/' . $fasilitas->gambar
                )
            )
        ) {
            unlink(
                storage_path(
                    'app/public/' . $fasilitas->gambar
                )
            );
        }

        $this->fasilitasRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil dihapus.',
        ]);
    }
}