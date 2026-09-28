<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ProgramRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function __construct(
        protected ProgramRepository $programRepository
    ) {
    }

    public function index(): View
    {
        $programs = $this->programRepository->getAll();

        return view('admin.program.index', compact('programs'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],

            'jenis' => [
                'required',
                'in:Program Unggulan,Ekstrakurikuler',
            ],

            'deskripsi' => ['nullable', 'string'],

            'pembina' => [
                'nullable',
                'string',
                'max:255',
            ],

            'jadwal' => [
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
                ->store('program', 'public');
        }

        $program = $this->programRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Program berhasil ditambahkan.',
            'data' => $program,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $program = $this->programRepository->findById($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $program,
        ]);
    }

    public function update(
        Request $request,
        int $id
    ): JsonResponse {
        $program = $this->programRepository->findById($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],

            'jenis' => [
                'required',
                'in:Program Unggulan,Ekstrakurikuler',
            ],

            'deskripsi' => ['nullable', 'string'],

            'pembina' => [
                'nullable',
                'string',
                'max:255',
            ],

            'jadwal' => [
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
                $program->gambar &&
                file_exists(
                    storage_path(
                        'app/public/' . $program->gambar
                    )
                )
            ) {
                unlink(
                    storage_path(
                        'app/public/' . $program->gambar
                    )
                );
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('program', 'public');

        } else {
            unset($validated['gambar']);
        }

        $updated = $this->programRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Program berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $program = $this->programRepository->findById($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan.',
            ], 404);
        }

        if (
            $program->gambar &&
            file_exists(
                storage_path(
                    'app/public/' . $program->gambar
                )
            )
        ) {
            unlink(
                storage_path(
                    'app/public/' . $program->gambar
                )
            );
        }

        $this->programRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Program berhasil dihapus.',
        ]);
    }
}