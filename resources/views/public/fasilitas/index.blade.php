@extends('public.layouts.app')

@section('title', 'Fasilitas - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                SARANA DAN PRASARANA
            </span>

            <h1>Fasilitas</h1>

            <p>
                Berbagai fasilitas yang tersedia untuk mendukung
                kegiatan pembelajaran dan aktivitas sekolah.
            </p>

        </div>
    </section>


    {{-- FASILITAS --}}
    <section class="section">
        <div class="container">

            @if ($fasilitas->count())

                <div class="fasilitas-grid">

                    @foreach ($fasilitas as $item)

                        <article class="fasilitas-card">

                            {{-- GAMBAR --}}
                            <div class="fasilitas-card-image">

                                @if ($item->gambar)

                                    <img
                                        src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->nama }}"
                                    >

                                @else

                                    <div class="fasilitas-placeholder"></div>

                                @endif

                            </div>


                            {{-- KONTEN --}}
                            <div class="fasilitas-card-content">

                                <h3>
                                    {{ $item->nama }}
                                </h3>


                                @if ($item->lokasi)

                                    <div class="fasilitas-location">
                                        <span class="fasilitas-info-label">
                                            Lokasi
                                        </span>

                                        <span>
                                            {{ $item->lokasi }}
                                        </span>
                                    </div>

                                @endif


                                @if ($item->deskripsi)

                                    <p>
                                        {{ $item->deskripsi }}
                                    </p>

                                @endif


                                @if ($item->kondisi)

                                    <span class="fasilitas-condition">
                                        {{ $item->kondisi }}
                                    </span>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <h3>
                        Fasilitas belum tersedia
                    </h3>

                    <p>
                        Informasi fasilitas sekolah akan ditampilkan
                        pada halaman ini.
                    </p>

                </div>

            @endif

        </div>
    </section>

@endsection