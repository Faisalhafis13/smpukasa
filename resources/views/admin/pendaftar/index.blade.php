@extends('admin.layouts.app')

@section('title', 'Pendaftar SPMB - Admin')
@section('page-title', 'Pendaftar SPMB')

@section('content')
    <div class="admin-page-header">
        <div>
            <span class="admin-eyebrow">PENERIMAAN</span>
            <h1>Pendaftar SPMB</h1>
            <p>Tinjau data calon murid dan perbarui status verifikasinya.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="admin-notice admin-notice-success" role="status">{{ session('success') }}</div>
    @endif

    <div class="admin-panel">
        <div class="admin-panel-header">
            <div>
                <h2>Daftar Pengajuan</h2>
                <p>{{ $pendaftarans->total() }} pendaftar</p>
            </div>
        </div>

        @include('admin.layouts.page-size', ['paginator' => $pendaftarans])
        <form method="GET" action="{{ route('admin.pendaftar.index') }}" class="admin-search-bar">
            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama, NISN, sekolah, atau kontak wali..."
                aria-label="Cari pendaftar"
            >
            <select name="filter_status" aria-label="Filter status pendaftar">
                <option value="">Semua status</option>
                @foreach ($statuses as $option)
                    <option value="{{ $option }}" @selected($status === $option)>{{ $option }}</option>
                @endforeach
            </select>
            <button type="submit" class="admin-btn admin-btn-primary">Terapkan</button>
            @if ($search || $status)
                <a href="{{ route('admin.pendaftar.index') }}" class="admin-btn admin-btn-secondary">Reset</a>
            @endif
        </form>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Calon Murid</th>
                        <th>Asal Sekolah</th>
                        <th>Orang Tua / Wali</th>
                        <th>Dikirim</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $index => $pendaftaran)
                        <tr>
                            <td>{{ $pendaftarans->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $pendaftaran->nama_lengkap }}</strong>
                                <small class="admin-cell-secondary">
                                    NISN: {{ $pendaftaran->nisn ?: '-' }} ·
                                    {{ $pendaftaran->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </small>
                                <small class="admin-cell-secondary">
                                    {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->translatedFormat('d M Y') }}
                                </small>
                                <small class="admin-cell-secondary">{{ $pendaftaran->alamat }}</small>
                            </td>
                            <td>{{ $pendaftaran->asal_sekolah }}</td>
                            <td>
                                <strong>{{ $pendaftaran->nama_orang_tua }}</strong>
                                <a class="admin-contact-link" href="tel:{{ $pendaftaran->no_hp }}">{{ $pendaftaran->no_hp }}</a>
                                @if ($pendaftaran->email)
                                    <a class="admin-contact-link" href="mailto:{{ $pendaftaran->email }}">{{ $pendaftaran->email }}</a>
                                @endif
                            </td>
                            <td>{{ $pendaftaran->created_at->translatedFormat('d M Y, H:i') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.pendaftar.update', $pendaftaran->id) }}" class="admin-status-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="search" value="{{ $search }}">
                                    <input type="hidden" name="filter_status" value="{{ $status }}">
                                    <select name="status" aria-label="Status {{ $pendaftaran->nama_lengkap }}">
                                        @foreach ($statuses as $option)
                                            <option value="{{ $option }}" @selected($pendaftaran->status === $option)>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="admin-btn admin-btn-secondary admin-btn-sm">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table-empty">
                                <strong>{{ $search || $status ? 'Tidak ada pendaftar yang cocok' : 'Belum ada pendaftar' }}</strong>
                                <p>{{ $search || $status ? 'Ubah kata kunci atau filter status.' : 'Pengajuan baru akan tampil di halaman ini.' }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('admin.layouts.pagination', ['paginator' => $pendaftarans])
    </div>
@endsection