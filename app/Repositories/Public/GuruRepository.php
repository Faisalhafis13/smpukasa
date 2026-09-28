<?php

namespace App\Repositories\Public;

use App\Models\Guru;

class GuruRepository
{
    public function getAll()
    {
        return Guru::orderBy('nama')->get();
    }

    public function getLatest(int $limit = 8)
    {
        return Guru::orderBy('nama')
            ->take($limit)
            ->get();
    }

    public function findById(int $id): ?Guru
    {
        return Guru::find($id);
    }
}