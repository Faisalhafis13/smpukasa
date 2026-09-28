<aside class="admin-sidebar" id="adminSidebar">

    <div class="admin-brand">

        <div class="admin-brand-logo">
            SK
        </div>

        <div class="admin-brand-text">
            <strong>SMP Unggulan</strong>
            <span>Karangsawo</span>
        </div>

    </div>

    <div class="admin-sidebar-menu">

        <div class="admin-menu-label">
            UTAMA
        </div>

        <a href="{{ route('admin.dashboard') }}"
            class="admin-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <span class="admin-menu-icon">⌂</span>
            <span>Dashboard</span>

        </a>


        <div class="admin-menu-label">
            KONTEN SEKOLAH
        </div>

        <a href="{{ route('admin.profil.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">

            <span class="admin-menu-icon">🏫</span>
            <span>Profil Sekolah</span>

        </a>

<a href="{{ route('admin.berita.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">

    <span class="admin-menu-icon">📰</span>
    <span>Berita</span>

</a>


<a href="{{ route('admin.galeri.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">

    <span class="admin-menu-icon">🖼️</span>
    <span>Galeri</span>

</a>

<a href="{{ route('admin.agenda.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">

    <span class="admin-menu-icon">📅</span>
    <span>Agenda</span>

</a>

        <div class="admin-menu-label">
            AKADEMIK
        </div>

<a href="{{ route('admin.prestasi.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">

    <span class="admin-menu-icon">🏆</span>
    <span>Prestasi</span>

</a>
<a
    href="{{ route('admin.fasilitas.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}"
>
    <span class="admin-menu-icon">🏫</span>
    <span>Fasilitas</span>
</a>

<a
    href="{{ route('admin.guru.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}"
>
    <span class="admin-menu-icon">👨‍🏫</span>
    <span>Guru</span>
</a>


<a
    href="{{ route('admin.program.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.program.*') ? 'active' : '' }}"
>
    <span class="admin-menu-icon">🎓</span>
    <span>Program & Ekstrakurikuler</span>
</a>

        <div class="admin-menu-label">
            PENERIMAAN
        </div>

<a
    href="{{ route('admin.spmb.index') }}"
    class="admin-menu-item {{ request()->routeIs('admin.spmb.*') ? 'active' : '' }}"
>
    <span class="admin-menu-icon">📝</span>
    <span>SPMB</span>
</a>


    </div>

    <div class="admin-sidebar-footer">

        <a href="{{ route('home') }}" target="_blank" class="admin-menu-item">

            <span class="admin-menu-icon">🌐</span>
            <span>Lihat Website</span>

        </a>

    </div>

</aside>