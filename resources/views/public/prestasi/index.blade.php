@extends('public.layouts.app')

@section('title', 'Prestasi - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                PENCAPAIAN SEKOLAH
            </span>

            <h1>Prestasi</h1>

            <p>
                Berbagai prestasi dan pencapaian yang diraih
                SMP Unggulan Karangsawo.
            </p>

        </div>
    </section>


    {{-- PRESTASI --}}
    <section class="section">
        <div class="container">

            @if ($prestasis->count())

                <div class="prestasi-grid">

                    @foreach ($prestasis as $prestasi)

                        <article class="prestasi-card">

                            {{-- GAMBAR --}}
                            <div class="prestasi-card-image">

                                @if ($prestasi->gambar)

                                    <img
                                        src="{{ asset('storage/' . $prestasi->gambar) }}"
                                        alt="{{ $prestasi->judul }}"
                                    >

                                @else

                                    <div class="prestasi-card-placeholder"></div>

                                @endif

                            </div>


                            {{-- KONTEN --}}
                            <div class="prestasi-card-content">

                                @if ($prestasi->tingkat)

                                    <span class="prestasi-level">
                                        {{ $prestasi->tingkat }}
                                    </span>

                                @endif


                                <h3>
                                    {{ $prestasi->judul }}
                                </h3>


                                @if ($prestasi->peraih)

                                    <div class="prestasi-winner">

                                        <span class="prestasi-info-label">
                                            Peraih
                                        </span>

                                        <span>
                                            {{ $prestasi->peraih }}
                                        </span>

                                    </div>

                                @endif


                                @if ($prestasi->deskripsi)

                                    <p class="prestasi-description">
                                        {{ $prestasi->deskripsi }}
                                    </p>

                                @endif


                                @if ($prestasi->kategori || $prestasi->tahun)

                                    <div class="prestasi-info">

                                        @if ($prestasi->kategori)

                                            <div class="prestasi-info-item">

                                                <span class="prestasi-info-label">
                                                    Kategori
                                                </span>

                                                <span>
                                                    {{ $prestasi->kategori }}
                                                </span>

                                            </div>

                                        @endif


                                        @if ($prestasi->tahun)

                                            <div class="prestasi-info-item">

                                                <span class="prestasi-info-label">
                                                    Tahun
                                                </span>

                                                <span>
                                                    {{ $prestasi->tahun }}
                                                </span>

                                            </div>

                                        @endif

                                    </div>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <h3>
                        Prestasi belum tersedia
                    </h3>

                    <p>
                        Data prestasi sekolah akan ditampilkan
                        pada halaman ini.
                    </p>

                </div>

            @endif

        </div>
    </section>

@endsection