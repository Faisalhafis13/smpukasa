<?php

namespace App\Repositories\Admin;

use App\Models\Berita;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BeritaRepository
{
    public function getAll(string $search = ''): LengthAwarePaginator
    {
        return Berita::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%")
                        ->orWhere('ringkasan', 'like', "%{$search}%")
                        ->orWhere('isi', 'like', "%{$search}%");
                });
            })
            ->latest('tanggal_publish')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(int $id): ?Berita
    {
        return Berita::find($id);
    }

    public function create(array $data): Berita
    {
        return Berita::create($data);
    }

    public function update(int $id, array $data): ?Berita
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return null;
        }

        $berita->update($data);

        return $berita->fresh();
    }

    public function delete(int $id): bool
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return false;
        }

        return $berita->delete();
    }
}