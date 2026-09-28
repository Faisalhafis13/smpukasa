@extends('public.layouts.app')

@section('title', 'Berita - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                INFORMASI
            </span>

            <h1>Berita Sekolah</h1>

            <p>
                Informasi terbaru mengenai kegiatan, prestasi, dan berbagai
                aktivitas SMP Unggulan Karangsawo.
            </p>

        </div>
    </section>


    {{-- BERITA --}}
    <section class="section">
        <div class="container">

            <div class="section-heading">

                <span class="section-label">
                    BERITA TERKINI
                </span>

                <h2>
                    Informasi Terbaru
                </h2>

                <p>
                    Temukan berbagai informasi terbaru dari
                    SMP Unggulan Karangsawo.
                </p>

            </div>


            @if ($beritas->count())

                <div class="news-grid">

                    @foreach ($beritas as $berita)

                        <article class="news-card">

                            {{-- GAMBAR --}}
                            <a
                                href="{{ route('berita.show', $berita->slug) }}"
                                class="news-card-image"
                            >

                                @if ($berita->gambar)

                                    <img
                                        src="{{ asset('storage/' . $berita->gambar) }}"
                                        alt="{{ $berita->judul }}"
                                    >

                                @else

                                    <div class="news-placeholder"></div>

                                @endif

                            </a>


                            {{-- KONTEN --}}
                            <div class="news-card-content">

                                {{-- TANGGAL --}}
                                <div class="news-meta">

                                    {{ $berita->tanggal_publish->translatedFormat('d F Y') }}

                                </div>


                                {{-- JUDUL --}}
                                <h3>

                                    <a
                                        href="{{ route('berita.show', $berita->slug) }}"
                                    >
                                        {{ $berita->judul }}
                                    </a>

                                </h3>


                                {{-- RINGKASAN --}}
                                @if ($berita->ringkasan)

                                    <p>
                                        {{ \Illuminate\Support\Str::limit($berita->ringkasan, 150) }}
                                    </p>

                                @elseif ($berita->isi)

                                    <p>
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 150) }}
                                    </p>

                                @endif


                                {{-- DETAIL --}}
                                <a
                                    href="{{ route('berita.show', $berita->slug) }}"
                                    class="news-read-more"
                                >
                                    <span>Baca Selengkapnya</span>
                                    <span class="news-read-arrow">→</span>
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <h3>
                        Belum Ada Berita
                    </h3>

                    <p>
                        Informasi berita sekolah akan ditampilkan
                        pada halaman ini.
                    </p>

                </div>

            @endif

        </div>
    </section>

@endsection