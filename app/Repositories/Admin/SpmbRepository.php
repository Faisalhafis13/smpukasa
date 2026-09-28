<?php

namespace App\Repositories\Admin;

use App\Models\Spmb;

class SpmbRepository
{
    public function getAll()
    {
        return Spmb::latest()->get();
    }

    public function findById(int $id): ?Spmb
    {
        return Spmb::find($id);
    }

    public function create(array $data): Spmb
    {
        return Spmb::create($data);
    }

    public function update(int $id, array $data): ?Spmb
    {
        $spmb = Spmb::find($id);

        if (!$spmb) {
            return null;
        }

        $spmb->update($data);

        return $spmb->fresh();
    }

    public function delete(int $id): bool
    {
        $spmb = Spmb::find($id);

        if (!$spmb) {
            return false;
        }

        return $spmb->delete();
    }
}