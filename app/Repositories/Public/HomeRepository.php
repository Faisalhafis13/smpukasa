<?php

namespace App\Repositories\Public;

class HomeRepository
{
    public function getHomeData(): array
    {
        return [
            'school' => [
                'name' => 'SMP Unggulan Karangsawo',
                'tagline' => 'Membentuk Generasi Unggul, Berkarakter, dan Berakhlak Mulia',
                'description' => 'Selamat datang di website resmi SMP Unggulan Karangsawo.',
            ],

            'latest_news' => [],

            'agenda' => [],

            'achievements' => [],

            'gallery' => [],
        ];
    }
}