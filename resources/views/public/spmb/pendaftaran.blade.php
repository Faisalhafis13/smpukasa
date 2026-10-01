@extends('public.layouts.app')

@section('title', 'Formulir Pendaftaran SPMB - SMP Unggulan Karangsawo')

@section('content')
    <section class="page-hero">
        <div class="container">
            <span class="section-eyebrow">PENERIMAAN MURID BARU</span>
            <h1>Formulir Pendaftaran</h1>
            <p>Lengkapi data calon murid dan orang tua/wali dengan benar.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="spmb-registration-panel">
                @if (session('success'))
                    <div class="spmb-registration-notice is-success" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if (! $spmb)
                    <div class="spmb-registration-closed" role="status">
                        <h2>Pendaftaran belum dibuka</h2>
                        <p>Silakan kembali ke informasi SPMB untuk melihat pengumuman periode pendaftaran.</p>
                        <a class="spmb-button" href="{{ route('spmb.index') }}">Lihat Informasi SPMB</a>
                    </div>
                @else
                    <div class="spmb-registration-heading">
                        <span class="spmb-section-label">PERIODE AKTIF</span>
                        <h2>{{ $spmb->judul }}</h2>
                        @if ($spmb->tanggal_mulai && $spmb->tanggal_selesai)
                            <p>
                                {{ $spmb->tanggal_mulai->translatedFormat('d F Y') }}
                                sampai
                                {{ $spmb->tanggal_selesai->translatedFormat('d F Y') }}
                            </p>
                        @endif
                    </div>

                    @if ($errors->any())
                        <div class="spmb-registration-notice is-error" role="alert">
                            <strong>Periksa kembali data yang diisi.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('spmb.pendaftaran.store') }}" class="spmb-registration-form">
                        @csrf

                        <fieldset>
                            <legend>Data Calon Murid</legend>

                            <div class="spmb-registration-grid">
                                <div class="spmb-registration-field is-full">
                                    <label for="nama_lengkap">Nama lengkap</label>
                                    <input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" autocomplete="name" maxlength="255" required>
                                </div>

                                <div class="spmb-registration-field">
                                    <label for="nisn">NISN <span>(opsional)</span></label>
                                    <input id="nisn" name="nisn" value="{{ old('nisn') }}" inputmode="numeric" autocomplete="off" maxlength="10">
                                    <small>Isi 10 digit jika sudah diketahui.</small>
                                </div>

                                <div class="spmb-registration-field">
                                    <label for="jenis_kelamin">Jenis kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                                        <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                                    </select>
                                </div>

                                <div class="spmb-registration-field">
                                    <label for="tempat_lahir">Tempat lahir</label>
                                    <input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" autocomplete="address-level2" maxlength="100" required>
                                </div>

                                <div class="spmb-registration-field">
                                    <label for="tanggal_lahir">Tanggal lahir</label>
                                    <input id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}" max="{{ now()->toDateString() }}" required>
                                </div>

                                <div class="spmb-registration-field is-full">
                                    <label for="asal_sekolah">Asal sekolah</label>
                                    <input id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" autocomplete="organization" maxlength="255" required>
                                </div>

                                <div class="spmb-registration-field is-full">
                                    <label for="alamat">Alamat tempat tinggal</label>
                                    <textarea id="alamat" name="alamat" rows="3" autocomplete="street-address" maxlength="2000" required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Data Orang Tua / Wali</legend>

                            <div class="spmb-registration-grid">
                                <div class="spmb-registration-field is-full">
                                    <label for="nama_orang_tua">Nama orang tua / wali</label>
                                    <input id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua') }}" autocomplete="name" maxlength="255" required>
                                </div>

                                <div class="spmb-registration-field">
                                    <label for="no_hp">Nomor HP / WhatsApp</label>
                                    <input id="no_hp" name="no_hp" type="tel" value="{{ old('no_hp') }}" autocomplete="tel" maxlength="30" required>
                                </div>

                                <div class="spmb-registration-field">
                                    <label for="email">Email <span>(opsional)</span></label>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" maxlength="255">
                                </div>
                            </div>
                        </fieldset>

                        <label class="spmb-registration-consent">
                            <input type="checkbox" name="persetujuan" value="1" @checked(old('persetujuan')) required>
                            <span>Saya menyatakan data yang diisi benar dan dapat dihubungi pihak sekolah terkait proses pendaftaran.</span>
                        </label>

                        <div class="spmb-registration-actions">
                            <a class="spmb-registration-cancel" href="{{ route('spmb.index') }}">Kembali ke SPMB</a>
                            <button class="spmb-button" type="submit">Kirim Pendaftaran</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection