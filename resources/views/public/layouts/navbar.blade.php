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

                <a
                    href="{{ route('home') }}"
                    class="nav-link"
                >
                    Beranda
                </a>

                <div class="nav-dropdown">

                    <button class="nav-link dropdown-button">
                        Profil
                        <span>⌄</span>
                    </button>

                    <div class="dropdown-menu">

                        <a href="#">
                            Tentang Sekolah
                        </a>

                        <a href="#">
                            Sejarah
                        </a>

                        <a href="#">
                            Visi & Misi
                        </a>

                        <a href="#">
                            Guru & Tenaga Kependidikan
                        </a>

                    </div>

                </div>

                <div class="nav-dropdown">

                    <button class="nav-link dropdown-button">
                        Akademik
                        <span>⌄</span>
                    </button>

                    <div class="dropdown-menu">

                        <a href="#">
                            Program Unggulan
                        </a>

                        <a href="#">
                            Ekstrakurikuler
                        </a>

                        <a href="#">
                            Prestasi
                        </a>

                    </div>

                </div>

                <div class="nav-dropdown">

                    <button class="nav-link dropdown-button">
                        Informasi
                        <span>⌄</span>
                    </button>

                    <div class="dropdown-menu">

                        <a href="#">
                            Berita
                        </a>

                        <a href="#">
                            Agenda
                        </a>

                        <a href="#">
                            Pengumuman
                        </a>

                    </div>

                </div>

                <a href="#" class="nav-link">
                    Galeri
                </a>

                <a href="#" class="nav-link">
                    Fasilitas
                </a>

                <a href="#" class="nav-link nav-cta">
                    SPMB
                </a>

            </div>

            {{-- MOBILE BUTTON --}}
            <button
                type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
            >
                ☰
            </button>

        </div>

    </nav>

</header>