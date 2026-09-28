<?php

namespace App\Repositories\Admin;

use App\Models\Prestasi;

class PrestasiRepository
{
    public function getAll()
    {
        return Prestasi::latest('tahun')
            ->latest('id')
            ->get();
    }

    public function findById(int $id): ?Prestasi
    {
        return Prestasi::find($id);
    }

    public function create(array $data): Prestasi
    {
        return Prestasi::create($data);
    }

    public function update(int $id, array $data): ?Prestasi
    {
        $prestasi = Prestasi::find($id);

        if (!$prestasi) {
            return null;
        }

        $prestasi->update($data);

        return $prestasi->fresh();
    }

    public function delete(int $id): bool
    {
        $prestasi = Prestasi::find($id);

        if (!$prestasi) {
            return false;
        }

        return $prestasi->delete();
    }
}