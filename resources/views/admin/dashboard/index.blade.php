@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - SMP Unggulan Karangsawo')

@section('page-title', 'Dashboard')

@section('content')

    <header class="admin-dashboard-intro">
        <div class="admin-dashboard-copy">
            <span class="admin-eyebrow">RINGKASAN SEKOLAH</span>
            <h1>Selamat datang, {{ auth()->user()->name }}</h1>
            <p>Pusat pengelolaan informasi dan kegiatan SMP Unggulan Karangsawo.</p>
        </div>
        <div class="admin-dashboard-date">
            <span>Hari ini</span>
            <strong>{{ now()->locale('id')->translatedFormat('d F Y') }}</strong>
        </div>
    </header>


    <div class="admin-stat-grid">

        <a href="{{ route('admin.profil.index') }}" class="admin-stat-card is-profile">
            <div>
                <span>Profil Sekolah</span>
                <strong>{{ $profilCount }}</strong>
                <small>Data profil</small>
            </div>
            <span class="admin-stat-action">Buka profil</span>
        </a>


        <a href="{{ route('admin.berita.index') }}" class="admin-stat-card is-news">
            <div>
                <span>Berita</span>
                <strong>{{ $beritaCount }}</strong>
                <small>Artikel berita</small>
            </div>
            <span class="admin-stat-action">Kelola berita</span>
        </a>


        <a href="{{ route('admin.agenda.index') }}" class="admin-stat-card is-agenda">
            <div>
                <span>Agenda</span>
                <strong>{{ $agendaCount }}</strong>
                <small>Agenda sekolah</small>
            </div>
            <span class="admin-stat-action">Lihat agenda</span>
        </a>


        <a href="{{ route('admin.prestasi.index') }}" class="admin-stat-card is-achievement">
            <div>
                <span>Prestasi</span>
                <strong>{{ $prestasiCount }}</strong>
                <small>Prestasi sekolah</small>
            </div>
            <span class="admin-stat-action">Lihat prestasi</span>
        </a>

        <a href="{{ route('admin.pendaftar.index') }}" class="admin-stat-card is-applicant">
            <div>
                <span>Pendaftar SPMB</span>
                <strong>{{ $pendaftarCount }}</strong>
                <small>{{ $pendingPendaftarCount }} menunggu verifikasi</small>
            </div>
            <span class="admin-stat-action">Tinjau pendaftar</span>
        </a>

    </div>


    <div class="admin-dashboard-grid">

        <div class="admin-panel">

            <div class="admin-panel-header">

                <div>
                    <h2>Kelola Konten</h2>
                    <p>Pilih modul untuk mulai bekerja.</p>
                </div>

            </div>

            <div class="admin-quick-grid">

                <a href="{{ route('admin.profil.index') }}"
                    class="admin-quick-card">

                    <div>
                        <strong>Profil Sekolah</strong>
                        <small>Kelola informasi sekolah</small>
                    </div>
                    <span class="admin-quick-action">Buka</span>

                </a>


                <a href="{{ route('admin.berita.index') }}" class="admin-quick-card">

                    <div>
                        <strong>Berita</strong>
                        <small>Kelola berita sekolah</small>
                    </div>
                    <span class="admin-quick-action">Buka</span>

                </a>


                <a href="{{ route('admin.galeri.index') }}" class="admin-quick-card">

                    <div>
                        <strong>Galeri</strong>
                        <small>Kelola dokumentasi</small>
                    </div>
                    <span class="admin-quick-action">Buka</span>

                </a>


                <a href="{{ route('admin.agenda.index') }}" class="admin-quick-card">

                    <div>
                        <strong>Agenda</strong>
                        <small>Kelola agenda sekolah</small>
                    </div>
                    <span class="admin-quick-action">Buka</span>

                </a>

            </div>

        </div>


        <div class="admin-panel">

            <div class="admin-panel-header">

                <div>
                    <h2>Pendaftar Terbaru</h2>
                    <p>{{ $pendingPendaftarCount }} pengajuan menunggu verifikasi</p>
                </div>

            </div>

            <div class="admin-system-list">
                @forelse ($recentPendaftarans as $pendaftaran)
                    <div class="admin-system-item admin-applicant-item">
                        <div>
                            <strong>{{ $pendaftaran->nama_lengkap }}</strong>
                            <small>{{ $pendaftaran->asal_sekolah }} · {{ $pendaftaran->created_at->translatedFormat('d M Y') }}</small>
                        </div>
                        <span class="admin-badge {{ $pendaftaran->status === 'Menunggu Verifikasi' ? 'admin-badge-warning' : 'admin-badge-success' }}">
                            {{ $pendaftaran->status }}
                        </span>
                    </div>
                @empty
                    <p class="admin-applicant-empty">Belum ada pengajuan pendaftaran.</p>
                @endforelse

                <a href="{{ route('admin.pendaftar.index') }}" class="admin-applicant-link">
                    Lihat semua pendaftar
                </a>
            </div>

        </div>

    </div>

@endsection