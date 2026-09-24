<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ProfilRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function __construct(
        protected ProfilRepository $profilRepository
    ) {
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $profils = $this->profilRepository->getAll($search);

        return view('admin.profil.index', compact('profils', 'search'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'npsn' => ['nullable', 'string', 'max:50'],
            'alamat' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'kepala_sekolah' => ['nullable', 'string', 'max:255'],
            'sambutan' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'sejarah' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],
        ]);

        $profil = $this->profilRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profil sekolah berhasil ditambahkan.',
            'data' => $profil,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $profil = $this->profilRepository->findById($id);

        if (!$profil) {
            return response()->json([
                'success' => false,
                'message' => 'Data profil tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profil,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'npsn' => ['nullable', 'string', 'max:50'],
            'alamat' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'kepala_sekolah' => ['nullable', 'string', 'max:255'],
            'sambutan' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'sejarah' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],
        ]);

        $profil = $this->profilRepository->update($id, $validated);

        if (!$profil) {
            return response()->json([
                'success' => false,
                'message' => 'Data profil tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil sekolah berhasil diperbarui.',
            'data' => $profil,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->profilRepository->delete($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Data profil tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil sekolah berhasil dihapus.',
        ]);
    }
}