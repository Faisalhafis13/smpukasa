<?php

namespace App\Repositories\Admin;

use App\Models\Agenda;

class AgendaRepository
{
    public function getAll()
    {
        return Agenda::orderBy('tanggal')
            ->orderBy('waktu')
            ->get();
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