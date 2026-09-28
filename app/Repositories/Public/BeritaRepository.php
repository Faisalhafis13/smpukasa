<?php

namespace App\Repositories\Public;

use App\Models\Berita;

class BeritaRepository
{
    /**
     * Mengambil seluruh berita.
     */
    public function getPublished()
    {
        return Berita::latest('created_at')
            ->latest('id')
            ->get();
    }

    /**
     * Mengambil berita terbaru.
     */
    public function getLatest(int $limit = 3)
    {
        return Berita::latest('created_at')
            ->latest('id')
            ->take($limit)
            ->get();
    }

    /**
     * Mengambil berita berdasarkan slug.
     */
    public function findBySlug(string $slug): ?Berita
    {
        return Berita::where('slug', $slug)
            ->first();
    }
}