<?php

namespace App\Repositories\Public;

use App\Models\Program;

class ProgramRepository
{
    public function getAll()
    {
        return Program::orderBy('jenis')
            ->orderBy('nama')
            ->get();
    }

    public function getByJenis(string $jenis)
    {
        return Program::where('jenis', $jenis)
            ->orderBy('nama')
            ->get();
    }

    public function getLatest(int $limit = 6)
    {
        return Program::latest()
            ->take($limit)
            ->get();
    }

    public function findById(int $id): ?Program
    {
        return Program::find($id);
    }
}