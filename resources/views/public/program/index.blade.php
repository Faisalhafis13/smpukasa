@extends('public.layouts.app')

@section('title')
    @if ($jenis === 'Program Unggulan')
        Program Unggulan
    @elseif ($jenis === 'Ekstrakurikuler')
        Ekstrakurikuler
    @else
        Program & Ekstrakurikuler
    @endif
    - SMP Unggulan Karangsawo
@endsection

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                AKADEMIK
            </span>

            @if ($jenis === 'Program Unggulan')

                <h1>
                    Program Unggulan
                </h1>

                <p>
                    Berbagai program unggulan yang diselenggarakan
                    untuk mendukung perkembangan dan potensi
                    peserta didik.
                </p>

            @elseif ($jenis === 'Ekstrakurikuler')

                <h1>
                    Ekstrakurikuler
                </h1>

                <p>
                    Berbagai kegiatan ekstrakurikuler yang menjadi
                    wadah bagi peserta didik untuk mengembangkan
                    minat, bakat, dan kreativitas.
                </p>

            @else

                <h1>
                    Program & Ekstrakurikuler
                </h1>

                <p>
                    Berbagai program unggulan dan kegiatan
                    ekstrakurikuler untuk mendukung perkembangan
                    potensi peserta didik.
                </p>

            @endif

        </div>
    </section>


    {{-- PROGRAM --}}
    <section class="section">
        <div class="container">

            {{-- FILTER --}}
            <div class="program-filter">

                <a
                    href="{{ route('program.index', ['jenis' => 'Program Unggulan']) }}"
                    class="program-filter-item {{ $jenis === 'Program Unggulan' ? 'active' : '' }}"
                >
                    Program Unggulan
                </a>

                <a
                    href="{{ route('program.index', ['jenis' => 'Ekstrakurikuler']) }}"
                    class="program-filter-item {{ $jenis === 'Ekstrakurikuler' ? 'active' : '' }}"
                >
                    Ekstrakurikuler
                </a>

                <a
                    href="{{ route('program.index') }}"
                    class="program-filter-item {{ $jenis === null ? 'active' : '' }}"
                >
                    Semua
                </a>

            </div>


            {{-- DATA --}}
            @if ($programs->count())

                <div class="program-grid">

                    @foreach ($programs as $program)

                        <article class="program-card">

                            {{-- GAMBAR --}}
                            <div class="program-card-image">

                                @if ($program->gambar)

                                    <img
                                        src="{{ asset('storage/' . $program->gambar) }}"
                                        alt="{{ $program->nama }}"
                                    >

                                @else

                                    <div class="program-placeholder"></div>

                                @endif

                            </div>


                            {{-- KONTEN --}}
                            <div class="program-card-content">

                                <span class="program-category">
                                    {{ $program->jenis }}
                                </span>

                                <h3>
                                    {{ $program->nama }}
                                </h3>


                                @if ($program->deskripsi)

                                    <p class="program-description">
                                        {{ $program->deskripsi }}
                                    </p>

                                @endif


                                <div class="program-details">

                                    @if ($program->pembina)

                                        <div class="program-info">

                                            <span class="program-info-label">
                                                Pembina
                                            </span>

                                            <span>
                                                {{ $program->pembina }}
                                            </span>

                                        </div>

                                    @endif


                                    @if ($program->jadwal)

                                        <div class="program-info">

                                            <span class="program-info-label">
                                                Jadwal
                                            </span>

                                            <span>
                                                {{ $program->jadwal }}
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    @if ($jenis === 'Program Unggulan')

                        <h3>
                            Program Unggulan Belum Tersedia
                        </h3>

                        <p>
                            Belum ada data program unggulan yang
                            ditambahkan melalui halaman administrasi.
                        </p>

                    @elseif ($jenis === 'Ekstrakurikuler')

                        <h3>
                            Ekstrakurikuler Belum Tersedia
                        </h3>

                        <p>
                            Belum ada data ekstrakurikuler yang
                            ditambahkan melalui halaman administrasi.
                        </p>

                    @else

                        <h3>
                            Program Belum Tersedia
                        </h3>

                        <p>
                            Informasi program dan ekstrakurikuler
                            akan ditampilkan pada halaman ini.
                        </p>

                    @endif

                </div>

            @endif

        </div>
    </section>

@endsection