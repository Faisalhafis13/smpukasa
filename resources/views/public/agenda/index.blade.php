@extends('public.layouts.app')

@section('title', 'Agenda - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">
            <span class="section-eyebrow">
                KEGIATAN SEKOLAH
            </span>

            <h1>Agenda</h1>

            <p>
                Informasi agenda dan berbagai kegiatan
                SMP Unggulan Karangsawo.
            </p>
        </div>
    </section>


    {{-- AGENDA --}}
    <section class="section">
        <div class="container">

            @if ($agendas->count())

                <div class="agenda-list">

                    @foreach ($agendas as $agenda)

                        <article class="agenda-card">

                            {{-- TANGGAL --}}
                            <div class="agenda-date">
                                <span class="agenda-day">
                                    {{ $agenda->tanggal->format('d') }}
                                </span>

                                <span class="agenda-month">
                                    {{ $agenda->tanggal->translatedFormat('M') }}
                                </span>
                            </div>


                            {{-- CONTENT --}}
                            <div class="agenda-card-content">

                                <div class="agenda-header">

                                    <span class="agenda-status">
                                        {{ $agenda->status === 'aktif'
                                            ? 'Agenda Mendatang'
                                            : 'Selesai' }}
                                    </span>

                                    <h3>
                                        {{ $agenda->judul }}
                                    </h3>

                                </div>


                                @if ($agenda->deskripsi)

                                    <p class="agenda-description">
                                        {{ $agenda->deskripsi }}
                                    </p>

                                @endif


                                {{-- INFORMASI --}}
                                <div class="agenda-info">

                                    @if ($agenda->waktu)
                                        <span class="agenda-info-item">
                                            <strong>Waktu</strong>
                                            {{ $agenda->waktu }}
                                        </span>
                                    @endif

                                    @if ($agenda->lokasi)
                                        <span class="agenda-info-item">
                                            <strong>Lokasi</strong>
                                            {{ $agenda->lokasi }}
                                        </span>
                                    @endif

                                    @if ($agenda->penyelenggara)
                                        <span class="agenda-info-item">
                                            <strong>Penyelenggara</strong>
                                            {{ $agenda->penyelenggara }}
                                        </span>
                                    @endif

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">
                    <h3>Agenda belum tersedia</h3>

                    <p>
                        Informasi kegiatan sekolah akan ditampilkan
                        pada halaman ini.
                    </p>
                </div>

            @endif

        </div>
    </section>

@endsection