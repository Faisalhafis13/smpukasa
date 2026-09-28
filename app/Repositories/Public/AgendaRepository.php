<?php

namespace App\Repositories\Public;

use App\Models\Agenda;

class AgendaRepository
{
    public function getAll()
    {
        return Agenda::orderBy('tanggal')
            ->orderBy('waktu')
            ->get();
    }

    public function getUpcoming(int $limit = 5)
    {
        return Agenda::where('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->take($limit)
            ->get();
    }

    public function findById(int $id): ?Agenda
    {
        return Agenda::find($id);
    }
}