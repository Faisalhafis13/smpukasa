<?php

namespace App\Repositories\Public;

use App\Models\Prestasi;

class PrestasiRepository
{
    public function getAll()
    {
        return Prestasi::latest('tahun')
            ->latest('id')
            ->get();
    }

    public function getLatest(int $limit = 6)
    {
        return Prestasi::latest('tahun')
            ->latest('id')
            ->take($limit)
            ->get();
    }

    public function findById(int $id): ?Prestasi
    {
        return Prestasi::find($id);
    }
}