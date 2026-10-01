<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\GaleriRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function __construct(
        protected GaleriRepository $galeriRepository
    ) {
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 10);
        $galeris = $this->galeriRepository->getAll($search, $perPage);

        return view('admin.galeri.index', compact('galeris', 'search'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'kategori' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['nullable', 'date'],
        ]);

        $validated['gambar'] = $request
            ->file('gambar')
            ->store('galeri', 'public');

        $galeri = $this->galeriRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil ditambahkan.',
            'data' => $galeri,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $galeri = $this->galeriRepository->findById($id);

        if (!$galeri) {
            return response()->json([
                'success' => false,
                'message' => 'Data galeri tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => array_merge($galeri->toArray(), [
                'tanggal' => $galeri->tanggal?->format('Y-m-d'),
            ]),
        ]);
    }

    public function update(
        Request $request,
        int $id
    ): JsonResponse {

        $galeri = $this->galeriRepository->findById($id);

        if (!$galeri) {
            return response()->json([
                'success' => false,
                'message' => 'Data galeri tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'kategori' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('gambar')) {

            if (
                $galeri->gambar &&
                file_exists(
                    storage_path('app/public/' . $galeri->gambar)
                )
            ) {
                unlink(
                    storage_path('app/public/' . $galeri->gambar)
                );
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('galeri', 'public');
        } else {
            unset($validated['gambar']);
        }

        $updated = $this->galeriRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Data galeri berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $galeri = $this->galeriRepository->findById($id);

        if (!$galeri) {
            return response()->json([
                'success' => false,
                'message' => 'Data galeri tidak ditemukan.',
            ], 404);
        }

        if (
            $galeri->gambar &&
            file_exists(
                storage_path('app/public/' . $galeri->gambar)
            )
        ) {
            unlink(
                storage_path('app/public/' . $galeri->gambar)
            );
        }

        $this->galeriRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil dihapus.',
        ]);
    }
}