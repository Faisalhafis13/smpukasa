@extends('public.layouts.app')

@section('title', 'Guru - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                TENAGA PENDIDIK
            </span>

            <h1>Guru</h1>

            <p>
                Tenaga pendidik SMP Unggulan Karangsawo yang
                mendukung proses pembelajaran dan perkembangan peserta didik.
            </p>

        </div>
    </section>


    {{-- DATA GURU --}}
    <section class="section">
        <div class="container">

            @if ($gurus->count())

                <div class="guru-grid">

                    @foreach ($gurus as $guru)

                        <article class="guru-card">

                            {{-- FOTO GURU --}}
                            <div class="guru-card-image">

                                @if ($guru->foto)

                                    <img
                                        src="{{ asset('storage/' . $guru->foto) }}"
                                        alt="{{ $guru->nama }}"
                                    >

                                @else

                                    <div class="guru-placeholder"></div>

                                @endif

                            </div>


                            {{-- INFORMASI GURU --}}
                            <div class="guru-card-content">

                                <span class="guru-position">
                                    {{ $guru->jabatan ?: 'Tenaga Pendidik' }}
                                </span>

                                <h3>
                                    {{ $guru->nama }}
                                </h3>


                                @if ($guru->mata_pelajaran)

                                    <div class="guru-info">

                                        <span class="guru-info-label">
                                            Mata Pelajaran
                                        </span>

                                        <span>
                                            {{ $guru->mata_pelajaran }}
                                        </span>

                                    </div>

                                @endif


                                @if ($guru->pendidikan)

                                    <div class="guru-info">

                                        <span class="guru-info-label">
                                            Pendidikan
                                        </span>

                                        <span>
                                            {{ $guru->pendidikan }}
                                        </span>

                                    </div>

                                @endif


                                @if ($guru->deskripsi)

                                    <p class="guru-description">
                                        {{ $guru->deskripsi }}
                                    </p>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <h3>
                        Data guru belum tersedia
                    </h3>

                    <p>
                        Informasi tenaga pendidik akan ditampilkan
                        pada halaman ini.
                    </p>

                </div>

            @endif

        </div>
    </section>

@endsection