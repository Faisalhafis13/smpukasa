<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-brand">
        <div class="admin-brand-logo">SK</div>
        <div class="admin-brand-text">
            <strong>SMP Unggulan</strong>
            <span>Karangsawo</span>
        </div>
    </div>

    <nav class="admin-sidebar-menu" aria-label="Navigasi admin">
        <a href="{{ route('admin.dashboard') }}"
           class="admin-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span>Dashboard</span>
        </a>

        <details class="admin-nav-group" @if (request()->routeIs('admin.profil.*', 'admin.berita.*', 'admin.galeri.*', 'admin.agenda.*')) open @endif>
            <summary class="admin-menu-label">Konten Sekolah</summary>
            <div class="admin-nav-group-items">
                <a href="{{ route('admin.profil.index') }}" class="admin-menu-item {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                    <span>Profil Sekolah</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="admin-menu-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <span>Berita</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="admin-menu-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <span>Galeri</span>
                </a>
                <a href="{{ route('admin.agenda.index') }}" class="admin-menu-item {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                    <span>Agenda</span>
                </a>
            </div>
        </details>

        <details class="admin-nav-group" @if (request()->routeIs('admin.prestasi.*', 'admin.fasilitas.*', 'admin.guru.*', 'admin.program.*')) open @endif>
            <summary class="admin-menu-label">Akademik</summary>
            <div class="admin-nav-group-items">
                <a href="{{ route('admin.prestasi.index') }}" class="admin-menu-item {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                    <span>Prestasi</span>
                </a>
                <a href="{{ route('admin.fasilitas.index') }}" class="admin-menu-item {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}">
                    <span>Fasilitas</span>
                </a>
                <a href="{{ route('admin.guru.index') }}" class="admin-menu-item {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                    <span>Guru</span>
                </a>
                <a href="{{ route('admin.program.index') }}" class="admin-menu-item {{ request()->routeIs('admin.program.*') ? 'active' : '' }}">
                    <span>Program & Ekstrakurikuler</span>
                </a>
            </div>
        </details>

        <details class="admin-nav-group" @if (request()->routeIs('admin.spmb.*', 'admin.pendaftar.*')) open @endif>
            <summary class="admin-menu-label">Penerimaan</summary>
            <div class="admin-nav-group-items">
                <a href="{{ route('admin.spmb.index') }}" class="admin-menu-item {{ request()->routeIs('admin.spmb.*') ? 'active' : '' }}">
                    <span>SPMB</span>
                </a>
                <a href="{{ route('admin.pendaftar.index') }}" class="admin-menu-item {{ request()->routeIs('admin.pendaftar.*') ? 'active' : '' }}">
                    <span>Pendaftar SPMB</span>
                </a>
            </div>
        </details>
    </nav>

    <div class="admin-sidebar-footer">
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="admin-menu-item">
            <span>Lihat Website</span>
        </a>
    </div>
</aside>