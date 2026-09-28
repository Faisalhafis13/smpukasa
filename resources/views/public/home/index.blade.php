@extends('public.layouts.app')

@section('title', 'Beranda - ' . ($data['school']['name'] ?? 'SMP Unggulan Karangsawo'))

@section('content')


{{-- =========================================================
    HERO
========================================================= --}}

@php
    /*
    |--------------------------------------------------------------------------
    | HERO SLIDES
    |--------------------------------------------------------------------------
    | Hanya mengambil data galeri yang memiliki gambar.
    | Maksimal 6 gambar digunakan sebagai background hero.
    | Slider berhenti pada gambar terakhir.
    */
    $heroSlides = $data['gallery']
        ->filter(fn ($gallery) => filled($gallery->gambar))
        ->take(6);
@endphp


{{-- =========================================================
    HERO SLIDESHOW
========================================================= --}}

@php
    $heroSlides = collect($data['gallery'] ?? [])
        ->filter(function ($gallery) {
            return !empty($gallery->gambar);
        })
        ->values()
        ->take(6);
@endphp


<section class="home-hero-v2">

    {{-- BACKGROUND --}}
    <div class="home-hero-background">

        @if ($heroSlides->count() > 0)

            @foreach ($heroSlides as $index => $gallery)

                <div
                    class="home-hero-slide {{ $index === 0 ? 'is-active' : '' }}"
                    data-hero-slide="{{ $index }}"
                >

                    <img
                        src="{{ asset('storage/' . $gallery->gambar) }}"
                        alt="{{ $gallery->judul ?? $data['school']['name'] }}"
                    >

                </div>

            @endforeach

        @else

            <div class="home-hero-background-placeholder"></div>

        @endif

    </div>


    {{-- OVERLAY --}}
    <div class="home-hero-overlay"></div>


    {{-- CONTENT --}}
    <div class="container home-hero-v2-container">

        <div class="home-hero-v2-content">

            <div class="home-hero-brand">

                @if (!empty($data['school']['logo']))

                    <img
                        src="{{ asset('storage/' . $data['school']['logo']) }}"
                        alt="Logo {{ $data['school']['name'] }}"
                    >

                @endif

                <span>
                    SEKOLAH UNGGULAN KARANGSAWO
                </span>

            </div>


            <h1>
                Membentuk Generasi
                <span>
                    Unggul untuk Masa Depan
                </span>
            </h1>


            <p>
                {{ $data['school']['deskripsi']
                    ?? 'Membangun lingkungan pendidikan yang mendukung perkembangan akademik, karakter, dan potensi peserta didik.' }}
            </p>


            <div class="home-hero-actions">

                <a
                    href="{{ route('profil.index') }}"
                    class="home-hero-button home-hero-button-primary"
                >
                    Kenal Lebih Dekat
                    <span>→</span>
                </a>


                <a
                    href="{{ route('spmb.index') }}"
                    class="home-hero-button home-hero-button-light"
                >
                    Informasi SPMB
                </a>

            </div>

        </div>


        <div class="home-hero-bottom">

            <span>
                SMP Unggulan Karangsawo
            </span>

            <span>
                Pendidikan · Karakter · Prestasi
            </span>

        </div>

    </div>

</section>


{{-- =========================================================
    QUICK INFO
========================================================= --}}

<section class="home-quick-info">

    <div class="container">

        <div class="home-quick-grid">


            {{-- ITEM 01 --}}
            <div class="home-quick-item">

                <span class="home-quick-number">
                    01
                </span>

                <div>

                    <strong>
                        Pendidikan
                    </strong>

                    <span>
                        Berorientasi pada perkembangan peserta didik
                    </span>

                </div>

            </div>


            {{-- ITEM 02 --}}
            <div class="home-quick-item">

                <span class="home-quick-number">
                    02
                </span>

                <div>

                    <strong>
                        Karakter
                    </strong>

                    <span>
                        Membentuk pribadi yang bertanggung jawab
                    </span>

                </div>

            </div>


            {{-- ITEM 03 --}}
            <div class="home-quick-item">

                <span class="home-quick-number">
                    03
                </span>

                <div>

                    <strong>
                        Prestasi
                    </strong>

                    <span>
                        Mengembangkan potensi akademik dan nonakademik
                    </span>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- =========================================================
    SAMBUTAN KEPALA SEKOLAH
========================================================= --}}

<section class="section home-about-v2">

    <div class="container">

        <div class="home-about-grid">


            {{-- FOTO KEPALA SEKOLAH --}}
            <div class="home-about-image">

                @if ($data['school']['foto_kepala'])

                    <img
                        src="{{ asset('storage/' . $data['school']['foto_kepala']) }}"
                        alt="{{ $data['school']['kepala_sekolah'] ?? 'Kepala Sekolah' }}"
                    >

                @else

                    <div class="home-about-placeholder"></div>

                @endif


                <div class="home-about-caption">

                    <span>
                        KEPALA SEKOLAH
                    </span>

                    <strong>
                        {{ $data['school']['kepala_sekolah'] ?? 'Kepala Sekolah' }}
                    </strong>

                </div>

            </div>


            {{-- SAMBUTAN --}}
            <div class="home-about-content">

                <span class="section-label">
                    SAMBUTAN KEPALA SEKOLAH
                </span>


                <h2>

                    Pendidikan yang Bertumbuh
                    Bersama Setiap Peserta Didik

                </h2>


                @if ($data['school']['sambutan'])

                    <div class="home-about-text">

                        {!! nl2br(e($data['school']['sambutan'])) !!}

                    </div>

                @else

                    <p class="home-about-text">

                        Selamat datang di website resmi
                        {{ $data['school']['name'] }}.
                        Informasi sambutan kepala sekolah
                        akan ditampilkan setelah data profil
                        sekolah tersedia.

                    </p>

                @endif


                <a
                    href="{{ route('profil.index') }}"
                    class="home-text-link"
                >

                    Mengenal Sekolah

                    <span>
                        →
                    </span>

                </a>

            </div>


        </div>

    </div>

</section>



{{-- =========================================================
    STATISTIK
========================================================= --}}

<section class="home-counter-section">

    <div class="container">


        <div class="home-counter-header">

            <span class="section-label">
                SEKILAS SEKOLAH
            </span>

            <h2>

                Tumbuh Bersama,
                Melangkah Lebih Jauh

            </h2>

        </div>


        <div class="home-counter-grid">


            <div class="home-counter-item">

                <strong>
                    0
                </strong>

                <span>
                    Peserta Didik
                </span>

            </div>


            <div class="home-counter-item">

                <strong>
                    0
                </strong>

                <span>
                    Guru & Tendik
                </span>

            </div>


            <div class="home-counter-item">

                <strong>
                    0
                </strong>

                <span>
                    Prestasi
                </span>

            </div>


            <div class="home-counter-item">

                <strong>
                    0
                </strong>

                <span>
                    Program
                </span>

            </div>


        </div>

    </div>

</section>



{{-- =========================================================
    NILAI SEKOLAH
========================================================= --}}

<section class="section">

    <div class="container">


        <div class="home-section-intro">

            <div>

                <span class="section-label">
                    NILAI SEKOLAH
                </span>

                <h2>

                    Ruang untuk Belajar,
                    Berkembang, dan Berprestasi

                </h2>

            </div>


            <p>

                Kami menghadirkan lingkungan pendidikan yang
                mendorong peserta didik untuk terus berkembang,
                mengenali potensi, dan membangun karakter positif.

            </p>

        </div>


        <div class="home-values-v2">


            {{-- VALUE 01 --}}
            <article>

                <span>
                    01
                </span>

                <h3>
                    Pendidikan Berkualitas
                </h3>

                <p>

                    Proses pembelajaran yang aktif, kreatif,
                    dan mendukung perkembangan peserta didik.

                </p>

            </article>


            {{-- VALUE 02 --}}
            <article>

                <span>
                    02
                </span>

                <h3>
                    Pengembangan Potensi
                </h3>

                <p>

                    Memberikan ruang bagi peserta didik untuk
                    mengembangkan bakat, minat, dan kreativitas.

                </p>

            </article>


            {{-- VALUE 03 --}}
            <article>

                <span>
                    03
                </span>

                <h3>
                    Karakter Positif
                </h3>

                <p>

                    Membentuk peserta didik yang bertanggung
                    jawab, percaya diri, dan peduli terhadap lingkungan.

                </p>

            </article>


        </div>

    </div>

</section>



{{-- =========================================================
    BERITA
========================================================= --}}

<section class="section section-light">

    <div class="container">


        <div class="home-section-heading">

            <div>

                <span class="section-label">
                    INFORMASI TERKINI
                </span>

                <h2>
                    Berita Terbaru
                </h2>

            </div>


            <a
                href="{{ route('berita.index') }}"
                class="home-text-link"
            >

                Lihat Semua

                <span>
                    →
                </span>

            </a>

        </div>


        @if ($data['latest_news']->count())


            @php

                $featuredNews = $data['latest_news']->first();

                $secondaryNews = $data['latest_news']->skip(1);

            @endphp


            <div class="home-news-editorial">


                {{-- BERITA UTAMA --}}
                <article class="home-news-featured">

                    <a
                        href="{{ route('berita.show', $featuredNews->slug) }}"
                        class="home-news-featured-image"
                    >

                        @if ($featuredNews->gambar)

                            <img
                                src="{{ asset('storage/' . $featuredNews->gambar) }}"
                                alt="{{ $featuredNews->judul }}"
                            >

                        @else

                            <div class="home-news-placeholder"></div>

                        @endif

                    </a>


                    <div class="home-news-featured-content">


                        @if ($featuredNews->tanggal_publish)

                            <span class="home-news-date">

                                {{ $featuredNews->tanggal_publish->translatedFormat('d F Y') }}

                            </span>

                        @endif


                        <h3>

                            <a
                                href="{{ route('berita.show', $featuredNews->slug) }}"
                            >

                                {{ $featuredNews->judul }}

                            </a>

                        </h3>


                        @if ($featuredNews->ringkasan)

                            <p>

                                {{ \Illuminate\Support\Str::limit(
                                    $featuredNews->ringkasan,
                                    220
                                ) }}

                            </p>

                        @elseif ($featuredNews->isi)

                            <p>

                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($featuredNews->isi),
                                    220
                                ) }}

                            </p>

                        @endif


                        <a
                            href="{{ route('berita.show', $featuredNews->slug) }}"
                            class="home-text-link"
                        >

                            Baca Selengkapnya

                            <span>
                                →
                            </span>

                        </a>


                    </div>

                </article>



                {{-- BERITA LAIN --}}
                <div class="home-news-secondary">


                    @foreach ($secondaryNews as $berita)


                        <article class="home-news-small">


                            <a
                                href="{{ route('berita.show', $berita->slug) }}"
                                class="home-news-small-image"
                            >

                                @if ($berita->gambar)

                                    <img
                                        src="{{ asset('storage/' . $berita->gambar) }}"
                                        alt="{{ $berita->judul }}"
                                    >

                                @else

                                    <div class="home-news-placeholder"></div>

                                @endif

                            </a>


                            <div class="home-news-small-content">


                                @if ($berita->tanggal_publish)

                                    <span class="home-news-date">

                                        {{ $berita->tanggal_publish->translatedFormat('d F Y') }}

                                    </span>

                                @endif


                                <h3>

                                    <a
                                        href="{{ route('berita.show', $berita->slug) }}"
                                    >

                                        {{ $berita->judul }}

                                    </a>

                                </h3>


                                <a
                                    href="{{ route('berita.show', $berita->slug) }}"
                                    class="home-news-small-link"
                                >

                                    Selengkapnya →

                                </a>


                            </div>


                        </article>


                    @endforeach


                </div>


            </div>


        @else


            <div class="empty-state">

                <h3>
                    Belum Ada Berita
                </h3>

                <p>

                    Informasi terbaru sekolah akan ditampilkan
                    pada bagian ini.

                </p>

            </div>


        @endif

    </div>

</section>



{{-- =========================================================
    PROGRAM
========================================================= --}}

<section class="section">

    <div class="container">


        <div class="home-section-heading">

            <div>

                <span class="section-label">
                    PROGRAM SEKOLAH
                </span>

                <h2>
                    Program & Kegiatan
                </h2>

            </div>


            <a
                href="{{ route('program.index') }}"
                class="home-text-link"
            >

                Lihat Semua

                <span>
                    →
                </span>

            </a>

        </div>


        <div class="home-program-v2">


            {{-- PROGRAM UNGGULAN --}}
            <a
                href="{{ route('program.index', ['jenis' => 'Program Unggulan']) }}"
                class="home-program-v2-card"
            >

                <div class="home-program-v2-number">
                    01
                </div>


                <div>

                    <span>
                        PROGRAM UNGGULAN
                    </span>

                    <h3>
                        Program Unggulan
                    </h3>

                    <p>

                        Program yang dirancang untuk mendukung
                        proses pembelajaran dan pengembangan
                        potensi peserta didik.

                    </p>

                </div>


                <strong>
                    Lihat Program →
                </strong>

            </a>



            {{-- EKSTRAKURIKULER --}}
            <a
                href="{{ route('program.index', ['jenis' => 'Ekstrakurikuler']) }}"
                class="home-program-v2-card"
            >

                <div class="home-program-v2-number">
                    02
                </div>


                <div>

                    <span>
                        KEGIATAN SISWA
                    </span>

                    <h3>
                        Ekstrakurikuler
                    </h3>

                    <p>

                        Wadah bagi peserta didik untuk
                        mengembangkan minat, bakat,
                        dan kreativitas.

                    </p>

                </div>


                <strong>
                    Lihat Kegiatan →
                </strong>

            </a>



            {{-- PRESTASI --}}
            <a
                href="{{ route('prestasi.index') }}"
                class="home-program-v2-card"
            >

                <div class="home-program-v2-number">
                    03
                </div>


                <div>

                    <span>
                        PENCAPAIAN
                    </span>

                    <h3>
                        Prestasi
                    </h3>

                    <p>

                        Berbagai pencapaian peserta didik
                        dalam bidang akademik maupun
                        nonakademik.

                    </p>

                </div>


                <strong>
                    Lihat Prestasi →
                </strong>

            </a>


        </div>

    </div>

</section>



{{-- =========================================================
    GALERI
    ---------------------------------------------------------
    SECTION INI TERPISAH DARI HERO.
    HERO TIDAK AKAN MENGARAH KE SECTION INI.
========================================================= --}}

<section class="section section-light">

    <div class="container">


        <div class="home-section-heading">

            <div>

                <span class="section-label">
                    DOKUMENTASI
                </span>

                <h2>
                    Momen Kegiatan Sekolah
                </h2>

            </div>


            <a
                href="{{ route('galeri.index') }}"
                class="home-text-link"
            >

                Lihat Galeri

                <span>
                    →
                </span>

            </a>

        </div>


        @if ($data['gallery']->count())


            @php

                $homeGallery = $data['gallery']->take(8);

            @endphp


            <div
                class="home-gallery-carousel"
                id="homeGalleryCarousel"
            >


                {{-- FOTO UTAMA --}}
                <div class="home-gallery-main">


                    @foreach ($homeGallery as $index => $gallery)


                        <div
                            class="home-gallery-slide {{ $index === 0 ? 'active' : '' }}"
                            data-slide="{{ $index }}"
                        >


                            @if ($gallery->gambar)

                                <img
                                    src="{{ asset('storage/' . $gallery->gambar) }}"
                                    alt="{{ $gallery->judul ?? 'Dokumentasi Kegiatan' }}"
                                >

                            @else

                                <div class="home-gallery-slide-placeholder"></div>

                            @endif


                            <div class="home-gallery-main-overlay">


                                <div class="home-gallery-main-info">

                                    <span>
                                        DOKUMENTASI KEGIATAN
                                    </span>

                                    <h3>
                                        {{ $gallery->judul ?? 'Momen Kegiatan Sekolah' }}
                                    </h3>

                                </div>


                                <div class="home-gallery-counter">

                                    <strong>

                                        {{ str_pad(
                                            $index + 1,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}

                                    </strong>

                                    <span>

                                        /
                                        {{ str_pad(
                                            $homeGallery->count(),
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}

                                    </span>

                                </div>


                            </div>


                        </div>


                    @endforeach


                    {{-- NAVIGASI GALERI --}}
                    @if ($homeGallery->count() > 1)


                        <div class="home-gallery-navigation">


                            <button
                                type="button"
                                class="home-gallery-nav home-gallery-prev"
                                aria-label="Foto sebelumnya"
                            >
                                ‹
                            </button>


                            <button
                                type="button"
                                class="home-gallery-nav home-gallery-next"
                                aria-label="Foto berikutnya"
                            >
                                ›
                            </button>


                        </div>


                    @endif


                </div>



                {{-- THUMBNAIL --}}
                @if ($homeGallery->count() > 1)


                    <div class="home-gallery-thumbnails">


                        @foreach ($homeGallery as $index => $gallery)


                            <button
                                type="button"
                                class="home-gallery-thumbnail {{ $index === 0 ? 'active' : '' }}"
                                data-slide-to="{{ $index }}"
                                aria-label="Lihat foto {{ $index + 1 }}"
                            >


                                @if ($gallery->gambar)

                                    <img
                                        src="{{ asset('storage/' . $gallery->gambar) }}"
                                        alt="{{ $gallery->judul ?? 'Dokumentasi Kegiatan' }}"
                                    >

                                @else

                                    <span class="home-gallery-thumbnail-placeholder"></span>

                                @endif


                            </button>


                        @endforeach


                    </div>


                @endif



                {{-- FOOTER GALERI --}}
                <div class="home-gallery-footer">


                    <p>

                        Dokumentasi kegiatan dan aktivitas
                        SMP Unggulan Karangsawo.

                    </p>


                    <a
                        href="{{ route('galeri.index') }}"
                        class="home-gallery-view-all"
                    >

                        Lihat Semua Dokumentasi

                        <span>
                            →
                        </span>

                    </a>


                </div>


            </div>


        @else


            <div class="empty-state">

                <h3>
                    Belum Ada Galeri
                </h3>

                <p>

                    Dokumentasi kegiatan sekolah akan ditampilkan
                    pada bagian ini.

                </p>

            </div>


        @endif

    </div>

</section>



{{-- =========================================================
    SPMB CTA
========================================================= --}}

<section class="home-spmb-v2">

    <div class="home-spmb-overlay"></div>


    <div class="container">

        <div class="home-spmb-content">


            <span class="section-label">
                PENERIMAAN MURID BARU
            </span>


            <h2>

                Mulai Perjalanan Pendidikan
                Bersama {{ $data['school']['name'] }}

            </h2>


            <p>

                Temukan informasi lengkap mengenai persyaratan,
                jadwal, alur, dan proses pendaftaran murid baru.

            </p>


            <a
                href="{{ route('spmb.index') }}"
                class="home-spmb-button"
            >

                Informasi SPMB

                <span>
                    →
                </span>

            </a>


        </div>

    </div>

</section>



{{-- =========================================================
    HERO SLIDER JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const heroSlider =
        document.getElementById('homeHeroSlider');


    if (!heroSlider) {
        return;
    }


    const slides =
        heroSlider.querySelectorAll('.home-hero-slide');


    /*
    |--------------------------------------------------------------------------
    | Kalau foto hero hanya 0 atau 1,
    | tidak perlu menjalankan slideshow.
    |--------------------------------------------------------------------------
    */

    if (slides.length <= 1) {
        return;
    }


    let currentSlide = 0;


    /*
    |--------------------------------------------------------------------------
    | Menampilkan slide tertentu
    |--------------------------------------------------------------------------
    */

    function showHeroSlide(index) {

        slides.forEach(function (slide, slideIndex) {

            if (slideIndex === index) {

                slide.classList.add('active');

            } else {

                slide.classList.remove('active');

            }

        });


        currentSlide = index;

    }


    /*
    |--------------------------------------------------------------------------
    | Tampilkan foto pertama
    |--------------------------------------------------------------------------
    */

    showHeroSlide(0);


    /*
    |--------------------------------------------------------------------------
    | SLIDESHOW
    |
    | Foto:
    | 1 → 2 → 3 → 4 → terakhir
    |
    | Setelah foto terakhir:
    | STOP.
    |
    | Tidak kembali ke foto pertama.
    | Tidak scroll.
    | Tidak membuka halaman galeri.
    |--------------------------------------------------------------------------
    */

    const heroInterval = setInterval(function () {


        if (currentSlide >= slides.length - 1) {

            clearInterval(heroInterval);

            return;

        }


        showHeroSlide(currentSlide + 1);


    }, 6000);

});

</script>


@endsection