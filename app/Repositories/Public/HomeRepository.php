<?php

namespace App\Repositories\Public;

use App\Models\Profil;
use App\Models\Galeri;
use App\Models\Program;
use App\Models\Berita;

class HomeRepository
{
    public function getHomeData(): array
    {
        $profil = Profil::latest()->first();

        $latestNews = Berita::latest('created_at')
            ->take(3)
            ->get();

        $gallery = Galeri::latest()
            ->take(6)
            ->get();

        $programs = Program::orderBy('jenis')
            ->orderBy('nama')
            ->get();

        return [
            'profil' => $profil,

            'school' => [
                'name' => $profil?->nama_sekolah ?? 'SMP Unggulan Karangsawo',
                'kepala_sekolah' => $profil?->kepala_sekolah,
                'sambutan' => $profil?->sambutan,
                'deskripsi' => $profil?->deskripsi,
                'alamat' => $profil?->alamat,
                'telepon' => $profil?->telepon,
                'email' => $profil?->email,
                'logo' => $profil?->logo,
                'foto_kepala' => $profil?->foto_kepala,
            ],

            'latest_news' => $latestNews,

            'agenda' => [],

            'achievements' => [],

            'gallery' => $gallery,

            'programs' => $programs,
        ];
    }
}