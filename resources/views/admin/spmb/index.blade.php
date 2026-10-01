@extends('admin.layouts.app')

@section('title', 'SPMB - Admin')
@section('page-title', 'SPMB')

@section('content')

<div class="admin-page-header">

    <div>

        <span class="admin-eyebrow">
            PENERIMAAN
        </span>

        <h1>SPMB</h1>

        <p>
            Kelola informasi Sistem Penerimaan Murid Baru.
        </p>

    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openSpmbModal()"
    >
        + Tambah SPMB
    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>

            <h2>Daftar SPMB</h2>

            <p>
                Informasi periode dan pendaftaran murid baru.
            </p>

        </div>

    </div>

    @include('admin.layouts.page-size', ['paginator' => $spmbs])
    <form method="GET" action="{{ route('admin.spmb.index') }}" class="admin-search-bar">
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari judul, status, kontak, atau link pendaftaran..."
            aria-label="Cari SPMB"
        >
        <button type="submit" class="admin-btn admin-btn-primary">Cari</button>
        @if ($search)
            <a href="{{ route('admin.spmb.index') }}" class="admin-btn admin-btn-secondary">Reset</a>
        @endif
    </form>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th>Judul</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Kontak</th>
                    <th width="150">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($spmbs as $index => $item)

                    <tr>

                        <td>
                            {{ $spmbs->firstItem() + $index }}
                        </td>

                        <td>
                            <strong>
                                {{ $item->judul }}
                            </strong>
                        </td>

                        <td>

                            @if ($item->tanggal_mulai && $item->tanggal_selesai)

                                {{ $item->tanggal_mulai->format('d M Y') }}
                                -
                                {{ $item->tanggal_selesai->format('d M Y') }}

                            @else

                                -

                            @endif

                        </td>

                        <td>

                            @if ($item->status === 'Dibuka')

                                <span
                                    class="admin-status-badge"
                                    style="
                                        background:#dcfce7;
                                        color:#166534;
                                    "
                                >
                                    Dibuka
                                </span>

                            @elseif ($item->status === 'Belum Dibuka')

                                <span
                                    class="admin-status-badge"
                                    style="
                                        background:#fef3c7;
                                        color:#92400e;
                                    "
                                >
                                    Belum Dibuka
                                </span>

                            @else

                                <span
                                    class="admin-status-badge"
                                    style="
                                        background:#fee2e2;
                                        color:#991b1b;
                                    "
                                >
                                    Ditutup
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $item->kontak ?: '-' }}
                        </td>

                        <td>

                            <div style="
                                display:flex;
                                gap:8px;
                            ">

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-secondary admin-btn-sm"
                                    onclick="editSpmb({{ $item->id }})"
                                >
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-danger admin-btn-sm"
                                    onclick="deleteSpmb({{ $item->id }})"
                                >
                                    Hapus
                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            style="
                                text-align:center;
                                padding:50px;
                            "
                        >

                            <strong>{{ $search ? 'Tidak ada informasi SPMB yang cocok' : 'Belum ada data SPMB' }}</strong>

                            <p style="
                                color:#64748b;
                                margin-top:5px;
                            ">
                                {{ $search ? 'Coba kata kunci lain.' : 'Tambahkan informasi SPMB pertama.' }}
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @include('admin.layouts.pagination', ['paginator' => $spmbs])

</div>


{{-- MODAL --}}

<div
    class="admin-modal"
    id="spmbModal"
    style="display:none;"
>

    <div
        class="admin-modal-overlay"
        onclick="closeSpmbModal()"
    ></div>


    <div class="admin-modal-content">

        <div class="admin-modal-header">

            <div>

                <h2 id="spmbModalTitle">
                    Tambah SPMB
                </h2>

                <p>
                    Lengkapi informasi penerimaan murid baru.
                </p>

            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closeSpmbModal()"
            >
                ×
            </button>

        </div>


        <form
            id="spmbForm"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                id="spmbId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="spmbJudul">
                        Judul SPMB
                    </label>

                    <input
                        type="text"
                        id="spmbJudul"
                        name="judul"
                        required
                        placeholder="Contoh: SPMB Tahun Pelajaran 2026/2027"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="spmbTanggalMulai">
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        id="spmbTanggalMulai"
                        name="tanggal_mulai"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="spmbTanggalSelesai">
                        Tanggal Selesai
                    </label>

                    <input
                        type="date"
                        id="spmbTanggalSelesai"
                        name="tanggal_selesai"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="spmbStatus">
                        Status
                    </label>

                    <select
                        id="spmbStatus"
                        name="status"
                        required
                    >

                        <option value="">
                            Pilih Status
                        </option>

                        <option value="Dibuka">
                            Dibuka
                        </option>

                        <option value="Belum Dibuka">
                            Belum Dibuka
                        </option>

                        <option value="Ditutup">
                            Ditutup
                        </option>

                    </select>

                </div>


                <div class="admin-form-group">

                    <label for="spmbKontak">
                        Kontak
                    </label>

                    <input
                        type="text"
                        id="spmbKontak"
                        name="kontak"
                        placeholder="Nomor telepon / WhatsApp"
                    >

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="spmbGambar">
                        Gambar / Banner
                    </label>

                    <input
                        type="file"
                        id="spmbGambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="spmbDeskripsi">
                        Deskripsi
                    </label>

                    <textarea
                        id="spmbDeskripsi"
                        name="deskripsi"
                        rows="4"
                        placeholder="Deskripsi SPMB..."
                    ></textarea>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="spmbPersyaratan">
                        Persyaratan
                    </label>

                    <textarea
                        id="spmbPersyaratan"
                        name="persyaratan"
                        rows="6"
                        placeholder="Tuliskan persyaratan pendaftaran..."
                    ></textarea>

                    <small>
                        Gunakan baris baru untuk setiap persyaratan.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="spmbAlur">
                        Alur Pendaftaran
                    </label>

                    <textarea
                        id="spmbAlur"
                        name="alur_pendaftaran"
                        rows="6"
                        placeholder="Tuliskan alur pendaftaran..."
                    ></textarea>

                    <small>
                        Gunakan baris baru untuk setiap tahapan.
                    </small>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closeSpmbModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                >
                    Simpan SPMB
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const spmbModal =
    document.getElementById('spmbModal');

const spmbForm =
    document.getElementById('spmbForm');

const spmbId =
    document.getElementById('spmbId');


function openSpmbModal()
{
    spmbForm.reset();

    spmbId.value = '';

    document.getElementById(
        'spmbModalTitle'
    ).textContent = 'Tambah SPMB';

    spmbModal.style.display = 'flex';
}


function closeSpmbModal()
{
    spmbModal.style.display = 'none';
}


async function editSpmb(id)
{
    try {

        const response =
            await fetch(`/admin/spmb/${id}`);

        const result =
            await response.json();

        if (!result.success) {

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: result.message
            });

            return;
        }


        const data = result.data;

        spmbId.value = data.id;

        document.getElementById(
            'spmbJudul'
        ).value = data.judul ?? '';

        document.getElementById(
            'spmbTanggalMulai'
        ).value = data.tanggal_mulai
            ? data.tanggal_mulai.substring(0, 10)
            : '';

        document.getElementById(
            'spmbTanggalSelesai'
        ).value = data.tanggal_selesai
            ? data.tanggal_selesai.substring(0, 10)
            : '';

        document.getElementById(
            'spmbStatus'
        ).value = data.status ?? '';

        document.getElementById(
            'spmbKontak'
        ).value = data.kontak ?? '';

        document.getElementById(
            'spmbDeskripsi'
        ).value = data.deskripsi ?? '';

        document.getElementById(
            'spmbPersyaratan'
        ).value = data.persyaratan ?? '';

        document.getElementById(
            'spmbAlur'
        ).value = data.alur_pendaftaran ?? '';

        document.getElementById(
            'spmbGambar'
        ).value = '';


        document.getElementById(
            'spmbModalTitle'
        ).textContent = 'Edit SPMB';

        spmbModal.style.display = 'flex';

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data SPMB gagal diambil.'
        });

    }
}


spmbForm.addEventListener(
    'submit',
    async function(event)
    {
        event.preventDefault();

        const id = spmbId.value;

        const formData =
            new FormData(this);

        let url = '/admin/spmb';

        if (id) {

            url = `/admin/spmb/${id}`;

            formData.append(
                '_method',
                'PUT'
            );
        }


        try {

            const response =
                await fetch(url, {

                    method: 'POST',

                    headers: {

                        'X-CSRF-TOKEN':
                            document
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                )
                                .getAttribute('content'),

                        'Accept':
                            'application/json'

                    },

                    body: formData

                });


            const result =
                await response.json();


            if (!response.ok) {

                const errors =
                    result.errors
                        ? Object.values(result.errors)
                            .flat()
                            .join('<br>')
                        : result.message;

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    html: errors
                });

                return;
            }


            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: result.message,
                timer: 1500,
                showConfirmButton: false
            });


            closeSpmbModal();

            setTimeout(() => {
                window.AdminAjax.refresh();
            }, 1500);

        } catch (error) {

            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text:
                    'Tidak dapat terhubung ke server.'
            });

        }

    }
);


async function deleteSpmb(id)
{
    const confirmation =
        await Swal.fire({

            title: 'Hapus data SPMB?',

            text:
                'Data SPMB yang dihapus tidak dapat dikembalikan.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Ya, Hapus',

            cancelButtonText: 'Batal'

        });


    if (!confirmation.isConfirmed) {
        return;
    }


    try {

        const response =
            await fetch(
                `/admin/spmb/${id}`,
                {

                    method: 'DELETE',

                    headers: {

                        'X-CSRF-TOKEN':
                            document
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                )
                                .getAttribute('content'),

                        'Accept':
                            'application/json'

                    }

                }
            );


        const result =
            await response.json();


        if (!response.ok) {

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: result.message
            });

            return;
        }


        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: result.message,
            timer: 1500,
            showConfirmButton: false
        });


        setTimeout(() => {
            window.AdminAjax.refresh();
        }, 1500);

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text:
                'Tidak dapat terhubung ke server.'
        });

    }
}

</script>

@endpush