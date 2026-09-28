@extends('public.layouts.app')

@section('title', $berita->judul . ' - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero page-hero-small">
        <div class="container">

            <span class="section-eyebrow">
                BERITA SEKOLAH
            </span>

            <h1>
                {{ $berita->judul }}
            </h1>

            <div class="article-meta">

                <span>
                    {{ $berita->tanggal_publish->translatedFormat('d F Y') }}
                </span>

                @if ($berita->kategori)
                    <span>
                        {{ $berita->kategori }}
                    </span>
                @endif

            </div>

        </div>
    </section>


    {{-- DETAIL BERITA --}}
    <section class="section">
        <div class="container">

            <article class="article-detail">

                {{-- GAMBAR UTAMA --}}
                @if ($berita->gambar)

                    <div class="article-image">

                        <img
                            src="{{ asset('storage/' . $berita->gambar) }}"
                            alt="{{ $berita->judul }}"
                        >

                    </div>

                @endif


                {{-- ISI --}}
                <div class="article-content">

                    @if ($berita->ringkasan)

                        <p class="article-summary">
                            {{ $berita->ringkasan }}
                        </p>

                    @endif


                    @if ($berita->isi)

                        <div class="article-body">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>

                    @else

                        <p class="empty-state-text">
                            Isi berita belum tersedia.
                        </p>

                    @endif

                </div>


                {{-- FOOTER --}}
                <div class="article-footer">

                    <a
                        href="{{ route('berita.index') }}"
                        class="btn btn-outline"
                    >
                        ← Kembali ke Berita
                    </a>

                </div>

            </article>

        </div>
    </section>

@endsection