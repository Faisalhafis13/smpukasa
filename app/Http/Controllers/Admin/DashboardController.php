<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\PendaftaranSpmb;
use App\Models\Prestasi;
use App\Models\Profil;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard.index', [
            'profilCount' => Profil::count(),
            'beritaCount' => Berita::count(),
            'agendaCount' => Agenda::count(),
            'prestasiCount' => Prestasi::count(),
            'pendaftarCount' => PendaftaranSpmb::count(),
            'pendingPendaftarCount' => PendaftaranSpmb::where('status', 'Menunggu Verifikasi')->count(),
            'recentPendaftarans' => PendaftaranSpmb::latest()->limit(5)->get(),
        ]);
    }
}