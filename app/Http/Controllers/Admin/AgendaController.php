<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\AgendaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function __construct(
        protected AgendaRepository $agendaRepository
    ) {
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 10);
        $agendas = $this->agendaRepository->getAll($search, $perPage);

        return view('admin.agenda.index', compact('agendas', 'search'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['nullable', 'date_format:H:i'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'penyelenggara' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:aktif,selesai'],
        ]);

        $agenda = $this->agendaRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil ditambahkan.',
            'data' => $agenda,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $agenda = $this->agendaRepository->findById($id);

        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $agenda,
        ]);
    }

    public function update(
        Request $request,
        int $id
    ): JsonResponse {

        $agenda = $this->agendaRepository->findById($id);

        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['nullable', 'date_format:H:i'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'penyelenggara' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:aktif,selesai'],
        ]);

        $updated = $this->agendaRepository->update(
            $id,
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil diperbarui.',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $agenda = $this->agendaRepository->findById($id);

        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan.',
            ], 404);
        }

        $this->agendaRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dihapus.',
        ]);
    }
}