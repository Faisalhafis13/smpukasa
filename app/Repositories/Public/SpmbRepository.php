<?php

namespace App\Repositories\Public;

use App\Models\Spmb;

class SpmbRepository
{
    public function getActive()
    {
        return Spmb::where('status', 'Dibuka')
            ->latest()
            ->get();
    }

    public function getLatest()
    {
        return Spmb::latest()->first();
    }

    public function findById(int $id): ?Spmb
    {
        return Spmb::find($id);
    }
}