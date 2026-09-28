@extends('public.layouts.app')

@section('title', 'Galeri - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                DOKUMENTASI SEKOLAH
            </span>

            <h1>Galeri</h1>

            <p>
                Dokumentasi kegiatan, prestasi, dan berbagai aktivitas
                SMP Unggulan Karangsawo.
            </p>

        </div>
    </section>


    {{-- GALERI --}}
    <section class="section">
        <div class="container">

            @if ($galeris->count())

                <div class="gallery-grid">

                    @foreach ($galeris as $galeri)

                        <article class="gallery-card">

                            {{-- GAMBAR --}}
                            <div class="gallery-card-image">

                                @if ($galeri->gambar)

                                    <img
                                        src="{{ asset('storage/' . $galeri->gambar) }}"
                                        alt="{{ $galeri->judul }}"
                                    >

                                @else

                                    <div class="gallery-placeholder"></div>

                                @endif

                            </div>


                            {{-- KONTEN --}}
                            <div class="gallery-card-content">

                                <span class="gallery-category">
                                    {{ $galeri->kategori ?: 'Dokumentasi' }}
                                </span>

                                <h3>
                                    {{ $galeri->judul }}
                                </h3>

                                @if ($galeri->deskripsi)

                                    <p>
                                        {{ $galeri->deskripsi }}
                                    </p>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <h3>
                        Galeri belum tersedia
                    </h3>

                    <p>
                        Dokumentasi sekolah akan ditampilkan di halaman ini.
                    </p>

                </div>

            @endif

        </div>
    </section>

@endsection