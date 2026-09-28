<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PrestasiRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrestasiController extends Controller
{
    public function __construct(
        protected PrestasiRepository $prestasiRepository
    ) {
    }

    public function index(): View
    {
        $prestasis = $this->prestasiRepository->getAll();

        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tingkat' => ['nullable', 'string', 'max:100'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'peraih' => ['nullable', 'string', 'max:255'],
            'penyelenggara' => ['nullable', 'string', 'max:255'],
            'tahun' => ['nullable', 'integer', 'min:1900', 'max:2100'],
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
                ->store('prestasi', 'public');
        }

        $prestasi = $this->prestasiRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Prestasi berhasil ditambahkan.',
            'data' => $prestasi,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $prestasi = $this->prestasiRepository->findById($id);

        if (!$prestasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data prestasi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $prestasi,
        ]);
    }

    public function update(
        Request $request,
        int $id
    ): JsonResponse {

        $prestasi = $this->prestasiRepository->findById($id);

        if (!$prestasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data prestasi tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tingkat' => ['nullable', 'string', 'max:100'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'peraih' => ['nullable', 'string', 'max:255'],
            'penyelenggara' => ['nullable', 'string', 'max:255'],
            'tahun' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('gambar')) {

            if (
                $prestasi->gambar &&
                file_exists(
                    storage_path('app/public/' . $prestasi->gambar)
                )
            ) {
                unlink(
                    storage_path('app/public/' . $prestasi->gambar)
                );
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('prestasi', 'public');
        } else {
            unset($validated['gambar']);
        }

        $updated = $this->prestasiRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Prestasi berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $prestasi = $this->prestasiRepository->findById($id);

        if (!$prestasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data prestasi tidak ditemukan.',
            ], 404);
        }

        if (
            $prestasi->gambar &&
            file_exists(
                storage_path('app/public/' . $prestasi->gambar)
            )
        ) {
            unlink(
                storage_path('app/public/' . $prestasi->gambar)
            );
        }

        $this->prestasiRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Prestasi berhasil dihapus.',
        ]);
    }
}