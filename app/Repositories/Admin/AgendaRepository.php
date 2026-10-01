<?php

namespace App\Repositories\Admin;

use App\Models\Agenda;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AgendaRepository
{
    public function getAll(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        $perPage = min(max($perPage, 10), 100);

        return Agenda::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhere('penyelenggara', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findById(int $id): ?Agenda
    {
        return Agenda::find($id);
    }

    public function create(array $data): Agenda
    {
        return Agenda::create($data);
    }

    public function update(int $id, array $data): ?Agenda
    {
        $agenda = Agenda::find($id);

        if (!$agenda) {
            return null;
        }

        $agenda->update($data);

        return $agenda->fresh();
    }

    public function delete(int $id): bool
    {
        $agenda = Agenda::find($id);

        if (!$agenda) {
            return false;
        }

        return $agenda->delete();
    }
}