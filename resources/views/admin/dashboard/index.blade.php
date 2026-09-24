@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - SMP Unggulan Karangsawo')

@section('page-title', 'Dashboard')

@section('content')

    <div class="admin-page-header">

        <div>
            <span class="admin-eyebrow">
                ADMIN PANEL
            </span>

            <h1>
                Selamat Datang, Administrator 👋
            </h1>

            <p>
                Kelola informasi dan konten website SMP Unggulan Karangsawo
                melalui halaman administrator.
            </p>
        </div>

    </div>


    <div class="admin-stat-grid">

        <div class="admin-stat-card">

            <div class="admin-stat-icon green">
                🏫
            </div>

            <div>
                <span>Profil Sekolah</span>
                <strong>1</strong>
                <small>Data profil</small>
            </div>

        </div>


        <div class="admin-stat-card">

            <div class="admin-stat-icon blue">
                📰
            </div>

            <div>
                <span>Berita</span>
                <strong>0</strong>
                <small>Artikel berita</small>
            </div>

        </div>


        <div class="admin-stat-card">

            <div class="admin-stat-icon orange">
                📅
            </div>

            <div>
                <span>Agenda</span>
                <strong>0</strong>
                <small>Agenda sekolah</small>
            </div>

        </div>


        <div class="admin-stat-card">

            <div class="admin-stat-icon purple">
                🏆
            </div>

            <div>
                <span>Prestasi</span>
                <strong>0</strong>
                <small>Prestasi sekolah</small>
            </div>

        </div>

    </div>


    <div class="admin-dashboard-grid">

        <div class="admin-panel">

            <div class="admin-panel-header">

                <div>
                    <h2>Akses Cepat</h2>
                    <p>Kelola konten website sekolah.</p>
                </div>

            </div>

            <div class="admin-quick-grid">

                <a href="{{ route('admin.profil.index') }}"
                    class="admin-quick-card">

                    <span>🏫</span>

                    <div>
                        <strong>Profil Sekolah</strong>
                        <small>Kelola informasi sekolah</small>
                    </div>

                </a>


                <a href="#" class="admin-quick-card">

                    <span>📰</span>

                    <div>
                        <strong>Berita</strong>
                        <small>Kelola berita sekolah</small>
                    </div>

                </a>


                <a href="#" class="admin-quick-card">

                    <span>🖼️</span>

                    <div>
                        <strong>Galeri</strong>
                        <small>Kelola dokumentasi</small>
                    </div>

                </a>


                <a href="#" class="admin-quick-card">

                    <span>📅</span>

                    <div>
                        <strong>Agenda</strong>
                        <small>Kelola agenda sekolah</small>
                    </div>

                </a>

            </div>

        </div>


        <div class="admin-panel">

            <div class="admin-panel-header">

                <div>
                    <h2>Informasi Sistem</h2>
                    <p>Status aplikasi</p>
                </div>

            </div>

            <div class="admin-system-list">

                <div class="admin-system-item">

                    <span class="status-dot"></span>

                    <div>
                        <strong>Website</strong>
                        <small>Berjalan dengan baik</small>
                    </div>

                </div>

                <div class="admin-system-item">

                    <span class="status-dot"></span>

                    <div>
                        <strong>Database</strong>
                        <small>Koneksi aktif</small>
                    </div>

                </div>

                <div class="admin-system-item">

                    <span class="status-dot"></span>

                    <div>
                        <strong>Administrator</strong>
                        <small>Sistem siap digunakan</small>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection