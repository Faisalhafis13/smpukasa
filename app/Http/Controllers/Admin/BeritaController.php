<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\BeritaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function __construct(
        protected BeritaRepository $beritaRepository
    ) {
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 10);
        $beritas = $this->beritaRepository->getAll($search, $perPage);

        return view('admin.berita.index', compact('beritas', 'search'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tanggal_publish' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['judul']
        );

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        $berita = $this->beritaRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan.',
            'data' => $berita,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $berita = $this->beritaRepository->findById($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => array_merge($berita->toArray(), [
                'tanggal_publish' => $berita->tanggal_publish?->format('Y-m-d'),
            ]),
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $berita = $this->beritaRepository->findById($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tanggal_publish' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['judul'],
            $id
        );

        if ($request->hasFile('gambar')) {

            if (
                $berita->gambar &&
                file_exists(storage_path('app/public/' . $berita->gambar))
            ) {
                unlink(
                    storage_path('app/public/' . $berita->gambar)
                );
            }

            $validated['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        } else {
            unset($validated['gambar']);
        }

        $updated = $this->beritaRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $berita = $this->beritaRepository->findById($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.',
            ], 404);
        }

        if (
            $berita->gambar &&
            file_exists(storage_path('app/public/' . $berita->gambar))
        ) {
            unlink(
                storage_path('app/public/' . $berita->gambar)
            );
        }

        $this->beritaRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus.',
        ]);
    }

    private function generateUniqueSlug(
        string $judul,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($judul);

        $originalSlug = $slug;
        $counter = 1;

        while (true) {

            $query = \App\Models\Berita::where(
                'slug',
                $slug
            );

            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }

            if (!$query->exists()) {
                return $slug;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
    }
}