<?php

namespace App\Repositories\Admin;

use App\Models\Prestasi;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PrestasiRepository
{
    public function getAll(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        $perPage = min(max($perPage, 10), 100);

        return Prestasi::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhere('tingkat', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%")
                        ->orWhere('peraih', 'like', "%{$search}%")
                        ->orWhere('penyelenggara', 'like', "%{$search}%");
                });
            })
            ->latest('tahun')
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
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