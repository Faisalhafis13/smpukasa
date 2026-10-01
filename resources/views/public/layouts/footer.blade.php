<footer class="site-footer">

    <div class="container">

        <div class="footer-grid">

            {{-- SEKOLAH --}}
            <div class="footer-column footer-school">

                <div class="footer-brand">

                    <div class="brand-logo">
                        SK
                    </div>

                    <div>
                        <strong>SMP Unggulan</strong>
                        <span>Karangsawo</span>
                    </div>

                </div>

                <p>
                    Website resmi SMP Unggulan Karangsawo sebagai
                    media informasi dan komunikasi sekolah.
                </p>

            </div>

            {{-- NAVIGASI --}}
            <div class="footer-column">

                <h3>Navigasi</h3>

                <a href="{{ route('home') }}">
                    Beranda
                </a>

                <a href="{{ route('profil.index') }}">
                    Tentang Sekolah
                </a>

                <a href="{{ route('guru.index') }}">
                    Guru &amp; Tenaga Kependidikan
                </a>

                <a href="{{ route('galeri.index') }}">
                    Galeri
                </a>

            </div>

            {{-- AKADEMIK --}}
            <div class="footer-column">

                <h3>Akademik</h3>

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

            {{-- INFORMASI --}}
            <div class="footer-column">

                <h3>Informasi</h3>

                <a href="{{ route('berita.index') }}">
                    Berita
                </a>

                <a href="{{ route('agenda.index') }}">
                    Agenda
                </a>

                <a href="{{ route('fasilitas.index') }}">
                    Fasilitas
                </a>

                <a href="{{ route('spmb.index') }}">
                    SPMB
                </a>

            </div>

        </div>

        <div class="footer-bottom">

            <p>
                © {{ date('Y') }} SMP Unggulan Karangsawo.
                Seluruh hak cipta dilindungi.
            </p>

        </div>

    </div>

</footer>