<?php

namespace App\Repositories\Admin;

use App\Models\Fasilitas;

class FasilitasRepository
{
    public function getAll()
    {
        return Fasilitas::latest()->get();
    }

    public function findById(int $id): ?Fasilitas
    {
        return Fasilitas::find($id);
    }

    public function create(array $data): Fasilitas
    {
        return Fasilitas::create($data);
    }

    public function update(int $id, array $data): ?Fasilitas
    {
        $fasilitas = Fasilitas::find($id);

        if (!$fasilitas) {
            return null;
        }

        $fasilitas->update($data);

        return $fasilitas->fresh();
    }

    public function delete(int $id): bool
    {
        $fasilitas = Fasilitas::find($id);

        if (!$fasilitas) {
            return false;
        }

        return $fasilitas->delete();
    }
}