@extends('public.layouts.app')

@section('title', 'SPMB - SMP Unggulan Karangsawo')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                PENERIMAAN MURID BARU
            </span>

            <h1>SPMB</h1>

            <p>
                Informasi penerimaan murid baru SMP Unggulan Karangsawo.
            </p>

        </div>
    </section>


    {{-- SPMB CONTENT --}}
    <section class="section">
        <div class="container">

            @if ($spmb)

                <article class="spmb-detail">

                    {{-- BANNER --}}
                    @if ($spmb->gambar)

                        <div class="spmb-banner">

                            <img
                                src="{{ asset('storage/' . $spmb->gambar) }}"
                                alt="{{ $spmb->judul }}"
                            >

                        </div>

                    @endif


                    {{-- HEADER --}}
                    <div class="spmb-header">

                        <span
                            class="spmb-status {{ strtolower(str_replace(' ', '-', $spmb->status)) }}"
                        >
                            {{ $spmb->status }}
                        </span>

                        <h2>
                            {{ $spmb->judul }}
                        </h2>


                        @if ($spmb->tanggal_mulai && $spmb->tanggal_selesai)

                            <div class="spmb-period">

                                <span class="spmb-meta-label">
                                    Periode Pendaftaran
                                </span>

                                <span>
                                    {{ $spmb->tanggal_mulai->translatedFormat('d F Y') }}
                                    —
                                    {{ $spmb->tanggal_selesai->translatedFormat('d F Y') }}
                                </span>

                            </div>

                        @endif

                    </div>


                    {{-- TENTANG --}}
                    @if ($spmb->deskripsi)

                        <section class="spmb-section">

                            <span class="spmb-section-label">
                                INFORMASI
                            </span>

                            <h3>
                                Tentang SPMB
                            </h3>

                            <p>
                                {{ $spmb->deskripsi }}
                            </p>

                        </section>

                    @endif


                    {{-- PERSYARATAN --}}
                    @if ($spmb->persyaratan)

                        <section class="spmb-section">

                            <span class="spmb-section-label">
                                PENDAFTARAN
                            </span>

                            <h3>
                                Persyaratan Pendaftaran
                            </h3>

                            <div class="spmb-text">
                                {!! nl2br(e($spmb->persyaratan)) !!}
                            </div>

                        </section>

                    @endif


                    {{-- ALUR --}}
                    @if ($spmb->alur_pendaftaran)

                        <section class="spmb-section">

                            <span class="spmb-section-label">
                                PROSES PENDAFTARAN
                            </span>

                            <h3>
                                Alur Pendaftaran
                            </h3>

                            <div class="spmb-text">
                                {!! nl2br(e($spmb->alur_pendaftaran)) !!}
                            </div>

                        </section>

                    @endif


                    {{-- ACTION --}}
                    <div class="spmb-action">

                        @if ($spmb->status === 'Dibuka')
                            <a
                                href="{{ route('spmb.pendaftaran.create') }}"
                                class="spmb-button"
                            >
                                Daftar Sekarang
                            </a>
                        @else
                            <span class="spmb-registration-unavailable" aria-disabled="true">
                                Pendaftaran Belum Dibuka
                            </span>
                        @endif


                        @if ($spmb->kontak)

                            <div class="spmb-contact">

                                <span class="spmb-contact-label">
                                    Informasi & Kontak
                                </span>

                                <span class="spmb-contact-value">
                                    {{ $spmb->kontak }}
                                </span>

                            </div>

                        @endif

                    </div>

                </article>

            @else

                <div class="empty-state">

                    <h3>
                        Informasi SPMB belum tersedia
                    </h3>

                    <p>
                        Informasi penerimaan murid baru akan
                        ditampilkan pada halaman ini.
                    </p>

                </div>

            @endif

        </div>
    </section>

@endsection