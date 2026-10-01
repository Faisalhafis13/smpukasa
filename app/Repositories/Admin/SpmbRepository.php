<?php

namespace App\Repositories\Admin;

use App\Models\Spmb;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SpmbRepository
{
    public function getAll(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        $perPage = min(max($perPage, 10), 100);

        return Spmb::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('kontak', 'like', "%{$search}%")
                        ->orWhere('link_pendaftaran', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
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