<?php

namespace App\Repositories\Admin;

use App\Models\Profil;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProfilRepository
{
    public function getAll(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        $perPage = min(max($perPage, 10), 100);

        return Profil::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_sekolah', 'like', "%{$search}%")
                        ->orWhere('npsn', 'like', "%{$search}%")
                        ->orWhere('kepala_sekolah', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('telepon', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findById(int $id): ?Profil
    {
        return Profil::find($id);
    }

    public function create(array $data): Profil
    {
        return Profil::create($data);
    }

    public function update(int $id, array $data): ?Profil
    {
        $profil = Profil::find($id);

        if (!$profil) {
            return null;
        }

        $profil->update($data);

        return $profil->fresh();
    }

    public function delete(int $id): bool
    {
        $profil = Profil::find($id);

        if (!$profil) {
            return false;
        }

        return $profil->delete();
    }
}