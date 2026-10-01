<?php

namespace App\Repositories\Admin;

use App\Models\Guru;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GuruRepository
{
    public function getAll(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        $perPage = min(max($perPage, 10), 100);

        return Guru::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('jabatan', 'like', "%{$search}%")
                        ->orWhere('mata_pelajaran', 'like', "%{$search}%")
                        ->orWhere('pendidikan', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
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