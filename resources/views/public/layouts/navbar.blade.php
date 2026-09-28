<header class="site-header">

    <nav class="navbar">

        <div class="container navbar-container">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="brand">

                <div class="brand-logo">
                    SK
                </div>

                <div class="brand-text">
                    <strong>SMP Unggulan</strong>
                    <span>Karangsawo</span>
                </div>

            </a>


            {{-- MENU --}}
            <div class="navbar-menu">

                {{-- BERANDA --}}
                <a
                    href="{{ route('home') }}"
                    class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                >
                    Beranda
                </a>


                {{-- PROFIL --}}
<div class="nav-dropdown">
    <button type="button" class="nav-link dropdown-button">
        Profil <span>⌄</span>
    </button>

    <div class="dropdown-menu">

        <a href="{{ route('profil.index') }}">
            Tentang Sekolah
        </a>


        <a href="{{ route('guru.index') }}">
            Guru & Tenaga Kependidikan
        </a>

    </div>
</div>

                {{-- AKADEMIK --}}
<div class="nav-dropdown">
    <button type="button" class="nav-link dropdown-button">
        Akademik <span>⌄</span>
    </button>

    <div class="dropdown-menu">
        <a href="{{ route('program.index', ['jenis' => 'Program Unggulan']) }}">
            Program Unggulan
        </a>

        <a href="{{ route('program.index', ['jenis' => 'Ekstrakurikuler']) }}">
            Ekstrakurikuler
        </a>

        <a href="{{ route('prestasi.index') }}">
            Prestasi
        </a>
    </div>
</div>


                {{-- INFORMASI --}}
                <div class="nav-dropdown">

                    <button
                        type="button"
                        class="nav-link dropdown-button"
                    >
                        Informasi
                        <span>⌄</span>
                    </button>

                    <div class="dropdown-menu">

                        <a href="{{ route('berita.index') }}">
                            Berita
                        </a>

                        <a href="{{ route('agenda.index') }}">
                            Agenda

                    </div>

                </div>


                {{-- GALERI --}}
                <a
                    href="{{ route('galeri.index') }}"
                    class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}"
                >
                    Galeri
                </a>


                {{-- FASILITAS --}}
                <a
                    href="{{ route('fasilitas.index') }}"
                    class="nav-link {{ request()->routeIs('fasilitas.*') ? 'active' : '' }}"
                >
                    Fasilitas
                </a>


                {{-- SPMB --}}
                <a
                    href="{{ route('spmb.index') }}"
                    class="nav-link nav-cta {{ request()->routeIs('spmb.*') ? 'active' : '' }}"
                >
                    SPMB
                </a>

            </div>


            {{-- MOBILE BUTTON --}}
            <button
                type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
                aria-label="Buka menu"
            >
                ☰
            </button>

        </div>

    </nav>

</header>