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

                <a href="#">
                    Profil
                </a>

                <a href="#">
                    Berita
                </a>

                <a href="#">
                    Galeri
                </a>

            </div>

            {{-- INFORMASI --}}
            <div class="footer-column">

                <h3>Informasi</h3>

                <a href="#">
                    Akademik
                </a>

                <a href="#">
                    Prestasi
                </a>

                <a href="#">
                    Fasilitas
                </a>

                <a href="#">
                    SPMB
                </a>

            </div>

            {{-- KONTAK --}}
            <div class="footer-column">

                <h3>Kontak</h3>

                <p>
                    📍 Alamat sekolah
                </p>

                <p>
                    ☎ Nomor telepon
                </p>

                <p>
                    ✉ Email sekolah
                </p>

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