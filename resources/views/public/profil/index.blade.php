@extends('public.layouts.app')

@section('title', 'Profil Sekolah - ' . ($profil->nama_sekolah ?? 'SMP Unggulan Karangsawo'))

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <span class="section-eyebrow">
                PROFIL SEKOLAH
            </span>

            <h1>
                {{ $profil->nama_sekolah ?? 'SMP Unggulan Karangsawo' }}
            </h1>

            <p>
                Mengenal lebih dekat identitas, sejarah, visi, dan misi
                sekolah.
            </p>

        </div>
    </section>


    {{-- TENTANG SEKOLAH --}}
    <section class="section">
        <div class="container">

            <div class="profile-intro">

                <div class="profile-intro-image">

                    @if ($profil?->logo)

                        <img
                            src="{{ asset('storage/' . $profil->logo) }}"
                            alt="Logo {{ $profil->nama_sekolah }}"
                        >

                    @else

                        <div class="profile-image-placeholder"></div>

                    @endif

                </div>


                <div class="profile-intro-content">

                    <span class="section-label">
                        TENTANG SEKOLAH
                    </span>

                    <h2>
                        {{ $profil->nama_sekolah ?? 'SMP Unggulan Karangsawo' }}
                    </h2>

                    @if ($profil?->deskripsi)

                        <div class="profile-description">
                            {!! nl2br(e($profil->deskripsi)) !!}
                        </div>

                    @else

                        <p>
                            Informasi mengenai profil sekolah belum tersedia.
                        </p>

                    @endif

                </div>

            </div>

        </div>
    </section>


    {{-- IDENTITAS SEKOLAH --}}
    <section class="section section-light">
        <div class="container">

            <div class="section-heading">

                <span class="section-label">
                    IDENTITAS SEKOLAH
                </span>

                <h2>
                    Informasi Sekolah
                </h2>

            </div>


            <div class="profile-info-grid">

                <div class="profile-info-card">

                    <span class="profile-info-label">
                        NPSN
                    </span>

                    <h3>
                        {{ $profil?->npsn ?? '-' }}
                    </h3>

                </div>


                <div class="profile-info-card">

                    <span class="profile-info-label">
                        KEPALA SEKOLAH
                    </span>

                    <h3>
                        {{ $profil?->kepala_sekolah ?? '-' }}
                    </h3>

                </div>


                <div class="profile-info-card">

                    <span class="profile-info-label">
                        EMAIL
                    </span>

                    <h3>
                        {{ $profil?->email ?? '-' }}
                    </h3>

                </div>

            </div>

        </div>
    </section>


    {{-- ALAMAT & KONTAK --}}
    <section class="section">
        <div class="container">

            <div class="section-heading">

                <span class="section-label">
                    INFORMASI KONTAK
                </span>

                <h2>
                    Alamat & Kontak
                </h2>

            </div>


            <div class="profile-contact-grid">

                <div class="profile-info-card">

                    <span class="profile-info-label">
                        ALAMAT
                    </span>

                    <h3>
                        {{ $profil?->alamat ?? '-' }}
                    </h3>

                </div>


                <div class="profile-info-card">

                    <span class="profile-info-label">
                        TELEPON
                    </span>

                    <h3>
                        {{ $profil?->telepon ?? '-' }}
                    </h3>

                </div>


                <div class="profile-info-card">

                    <span class="profile-info-label">
                        EMAIL
                    </span>

                    <h3>
                        {{ $profil?->email ?? '-' }}
                    </h3>

                </div>

            </div>

        </div>
    </section>


    {{-- SAMBUTAN KEPALA SEKOLAH --}}
    <section class="section section-light">
        <div class="container">

            <div class="profile-principal">

                <div class="profile-principal-image">

                    @if ($profil?->foto_kepala)

                        <img
                            src="{{ asset('storage/' . $profil->foto_kepala) }}"
                            alt="{{ $profil->kepala_sekolah ?? 'Kepala Sekolah' }}"
                        >

                    @else

                        <div class="profile-image-placeholder"></div>

                    @endif

                </div>


                <div class="profile-principal-content">

                    <span class="section-label">
                        SAMBUTAN KEPALA SEKOLAH
                    </span>

                    <h2>
                        {{ $profil?->kepala_sekolah ?? 'Kepala Sekolah' }}
                    </h2>

                    @if ($profil?->sambutan)

                        <div class="profile-sambutan">
                            {!! nl2br(e($profil->sambutan)) !!}
                        </div>

                    @else

                        <p>
                            Sambutan kepala sekolah belum tersedia.
                        </p>

                    @endif

                </div>

            </div>

        </div>
    </section>


    {{-- SEJARAH --}}
    <section class="section">
        <div class="container">

            <div class="section-heading">

                <span class="section-label">
                    SEJARAH
                </span>

                <h2>
                    Sejarah Sekolah
                </h2>

            </div>


            <div class="profile-content-card">

                @if ($profil?->sejarah)

                    <div class="profile-content-text">
                        {!! nl2br(e($profil->sejarah)) !!}
                    </div>

                @else

                    <p>
                        Informasi sejarah sekolah belum tersedia.
                    </p>

                @endif

            </div>

        </div>
    </section>


    {{-- VISI MISI --}}
    <section class="section section-light">
        <div class="container">

            <div class="section-heading">

                <span class="section-label">
                    VISI & MISI
                </span>

                <h2>
                    Visi dan Misi Sekolah
                </h2>

            </div>


            <div class="profile-vision-grid">

                {{-- VISI --}}
                <div class="profile-content-card">

                    <span class="section-label">
                        VISI
                    </span>

                    @if ($profil?->visi)

                        <div class="profile-content-text">
                            {!! nl2br(e($profil->visi)) !!}
                        </div>

                    @else

                        <p>
                            Visi sekolah belum tersedia.
                        </p>

                    @endif

                </div>


                {{-- MISI --}}
                <div class="profile-content-card">

                    <span class="section-label">
                        MISI
                    </span>

                    @if ($profil?->misi)

                        <div class="profile-content-text">
                            {!! nl2br(e($profil->misi)) !!}
                        </div>

                    @else

                        <p>
                            Misi sekolah belum tersedia.
                        </p>

                    @endif

                </div>

            </div>

        </div>
    </section>

@endsection