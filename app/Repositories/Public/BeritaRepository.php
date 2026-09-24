<?php

namespace App\Repositories\Public;

use App\Models\Berita;

class BeritaRepository
{
    public function getPublished()
    {
        return Berita::where('status', 'published')
            ->whereNotNull('tanggal_publish')
            ->whereDate('tanggal_publish', '<=', now())
            ->latest('tanggal_publish')
            ->latest('id')
            ->get();
    }

    public function getLatest(int $limit = 3)
    {
        return Berita::where('status', 'published')
            ->whereNotNull('tanggal_publish')
            ->whereDate('tanggal_publish', '<=', now())
            ->latest('tanggal_publish')
            ->latest('id')
            ->take($limit)
            ->get();
    }

    public function findBySlug(string $slug): ?Berita
    {
        return Berita::where('slug', $slug)
            ->where('status', 'published')
            ->whereDate('tanggal_publish', '<=', now())
            ->first();
    }
}