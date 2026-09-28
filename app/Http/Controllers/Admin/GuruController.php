<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\GuruRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function __construct(
        protected GuruRepository $guruRepository
    ) {
    }

    public function index(): View
    {
        $gurus = $this->guruRepository->getAll();

        return view('admin.guru.index', compact('gurus'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'mata_pelajaran' => ['nullable', 'string', 'max:255'],
            'pendidikan' => ['nullable', 'string', 'max:255'],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'deskripsi' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request
                ->file('foto')
                ->store('guru', 'public');
        }

        $guru = $this->guruRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil ditambahkan.',
            'data' => $guru,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $guru = $this->guruRepository->findById($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $guru,
        ]);
    }

    public function update(
        Request $request,
        int $id
    ): JsonResponse {
        $guru = $this->guruRepository->findById($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'mata_pelajaran' => ['nullable', 'string', 'max:255'],
            'pendidikan' => ['nullable', 'string', 'max:255'],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'deskripsi' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {

            if (
                $guru->foto &&
                file_exists(
                    storage_path(
                        'app/public/' . $guru->foto
                    )
                )
            ) {
                unlink(
                    storage_path(
                        'app/public/' . $guru->foto
                    )
                );
            }

            $validated['foto'] = $request
                ->file('foto')
                ->store('guru', 'public');

        } else {

            unset($validated['foto']);

        }

        $updated = $this->guruRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $guru = $this->guruRepository->findById($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan.',
            ], 404);
        }

        if (
            $guru->foto &&
            file_exists(
                storage_path(
                    'app/public/' . $guru->foto
                )
            )
        ) {
            unlink(
                storage_path(
                    'app/public/' . $guru->foto
                )
            );
        }

        $this->guruRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil dihapus.',
        ]);
    }
}