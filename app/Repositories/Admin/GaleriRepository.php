<?php

namespace App\Repositories\Admin;

use App\Models\Galeri;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GaleriRepository
{
    public function getAll(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        $perPage = min(max($perPage, 10), 100);

        return Galeri::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->latest('tanggal')
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findById(int $id): ?Galeri
    {
        return Galeri::find($id);
    }

    public function create(array $data): Galeri
    {
        return Galeri::create($data);
    }

    public function update(int $id, array $data): ?Galeri
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return null;
        }

        $galeri->update($data);

        return $galeri->fresh();
    }

    public function delete(int $id): bool
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return false;
        }

        return $galeri->delete();
    }
}