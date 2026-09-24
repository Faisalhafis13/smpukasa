<?php

namespace App\Repositories\Public;

use App\Models\Galeri;

class GaleriRepository
{
    public function getAll()
    {
        return Galeri::latest('tanggal')
            ->latest('id')
            ->get();
    }

    public function getLatest(int $limit = 6)
    {
        return Galeri::latest('tanggal')
            ->latest('id')
            ->take($limit)
            ->get();
    }

    public function findById(int $id): ?Galeri
    {
        return Galeri::find($id);
    }
}