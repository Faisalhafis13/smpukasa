<?php

namespace App\Repositories\Admin;

use App\Models\Fasilitas;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FasilitasRepository
{
    public function getAll(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        $perPage = min(max($perPage, 10), 100);

        return Fasilitas::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhere('kondisi', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
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