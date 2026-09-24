@extends('public.layouts.app')

@section('title', 'Galeri - SMP Unggulan Karangsawo')

@section('content')

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


    <section class="section">

        <div class="container">

            @if ($galeris->count())

                <div class="gallery-grid">

                    @foreach ($galeris as $galeri)

                        <article class="gallery-card">

                            <img
                                src="{{ asset('storage/' . $galeri->gambar) }}"
                                alt="{{ $galeri->judul }}"
                            >

                            <div class="gallery-card-content">

                                <span>
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