<?php

namespace App\Repositories\Public;

use App\Models\Fasilitas;

class FasilitasRepository
{
    public function getAll()
    {
        return Fasilitas::latest()->get();
    }

    public function getLatest(int $limit = 6)
    {
        return Fasilitas::latest()
            ->take($limit)
            ->get();
    }

    public function findById(int $id): ?Fasilitas
    {
        return Fasilitas::find($id);
    }
}