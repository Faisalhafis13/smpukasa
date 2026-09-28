<?php

namespace App\Repositories\Admin;

use App\Models\Guru;

class GuruRepository
{
    public function getAll()
    {
        return Guru::latest()->get();
    }

    public function findById(int $id): ?Guru
    {
        return Guru::find($id);
    }

    public function create(array $data): Guru
    {
        return Guru::create($data);
    }

    public function update(int $id, array $data): ?Guru
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return null;
        }

        $guru->update($data);

        return $guru->fresh();
    }

    public function delete(int $id): bool
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return false;
        }

        return $guru->delete();
    }
}