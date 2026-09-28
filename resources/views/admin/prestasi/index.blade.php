@extends('admin.layouts.app')

@section('title', 'Prestasi - Admin')
@section('page-title', 'Prestasi')

@section('content')

<div class="admin-page-header">

    <div>

        <span class="admin-eyebrow">
            AKADEMIK
        </span>

        <h1>Prestasi</h1>

        <p>
            Kelola data prestasi yang diraih oleh sekolah,
            siswa, maupun guru.
        </p>

    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openPrestasiModal()"
    >
        + Tambah Prestasi
    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>

            <h2>Daftar Prestasi</h2>

            <p>
                Data pencapaian dan prestasi sekolah.
            </p>

        </div>

    </div>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th width="90">Gambar</th>
                    <th>Prestasi</th>
                    <th>Peraih</th>
                    <th>Tingkat</th>
                    <th>Tahun</th>
                    <th width="150">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($prestasis as $index => $prestasi)

                    <tr>

                        <td>
                            {{ $index + 1 }}
                        </td>

                        <td>

                            @if ($prestasi->gambar)

                                <img
                                    src="{{ asset('storage/' . $prestasi->gambar) }}"
                                    alt="{{ $prestasi->judul }}"
                                    style="
                                        width:70px;
                                        height:50px;
                                        object-fit:cover;
                                        border-radius:8px;
                                    "
                                >

                            @else

                                <div style="
                                    width:70px;
                                    height:50px;
                                    border-radius:8px;
                                    background:#f1f5f9;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:20px;
                                ">
                                    🏆
                                </div>

                            @endif

                        </td>

                        <td>

                            <strong>
                                {{ $prestasi->judul }}
                            </strong>

                            @if ($prestasi->kategori)

                                <small style="
                                    display:block;
                                    margin-top:5px;
                                    color:#64748b;
                                ">
                                    {{ $prestasi->kategori }}
                                </small>

                            @endif

                        </td>

                        <td>
                            {{ $prestasi->peraih ?: '-' }}
                        </td>

                        <td>
                            {{ $prestasi->tingkat ?: '-' }}
                        </td>

                        <td>
                            {{ $prestasi->tahun ?: '-' }}
                        </td>

                        <td>

                            <div style="
                                display:flex;
                                gap:8px;
                            ">

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-secondary admin-btn-sm"
                                    onclick="editPrestasi({{ $prestasi->id }})"
                                >
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-danger admin-btn-sm"
                                    onclick="deletePrestasi({{ $prestasi->id }})"
                                >
                                    Hapus
                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            style="
                                text-align:center;
                                padding:50px;
                            "
                        >

                            <div style="
                                font-size:45px;
                                margin-bottom:10px;
                            ">
                                🏆
                            </div>

                            <strong>
                                Belum ada prestasi
                            </strong>

                            <p style="
                                color:#64748b;
                                margin-top:5px;
                            ">
                                Tambahkan prestasi pertama.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL --}}

<div
    class="admin-modal"
    id="prestasiModal"
    style="display:none;"
>

    <div
        class="admin-modal-overlay"
        onclick="closePrestasiModal()"
    ></div>


    <div class="admin-modal-content">

        <div class="admin-modal-header">

            <div>

                <h2 id="prestasiModalTitle">
                    Tambah Prestasi
                </h2>

                <p>
                    Lengkapi informasi prestasi.
                </p>

            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closePrestasiModal()"
            >
                ×
            </button>

        </div>


        <form
            id="prestasiForm"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                id="prestasiId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="prestasiJudul">
                        Judul Prestasi
                    </label>

                    <input
                        type="text"
                        id="prestasiJudul"
                        name="judul"
                        required
                        placeholder="Contoh: Juara 1 Olimpiade Sains"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="prestasiKategori">
                        Kategori
                    </label>

                    <input
                        type="text"
                        id="prestasiKategori"
                        name="kategori"
                        placeholder="Contoh: Akademik"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="prestasiTingkat">
                        Tingkat
                    </label>

                    <input
                        type="text"
                        id="prestasiTingkat"
                        name="tingkat"
                        placeholder="Contoh: Kabupaten"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="prestasiPeraih">
                        Peraih
                    </label>

                    <input
                        type="text"
                        id="prestasiPeraih"
                        name="peraih"
                        placeholder="Nama siswa / guru / sekolah"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="prestasiPenyelenggara">
                        Penyelenggara
                    </label>

                    <input
                        type="text"
                        id="prestasiPenyelenggara"
                        name="penyelenggara"
                        placeholder="Nama penyelenggara"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="prestasiTahun">
                        Tahun
                    </label>

                    <input
                        type="number"
                        id="prestasiTahun"
                        name="tahun"
                        min="1900"
                        max="2100"
                        placeholder="2026"
                    >

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="prestasiGambar">
                        Gambar
                    </label>

                    <input
                        type="file"
                        id="prestasiGambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="prestasiDeskripsi">
                        Deskripsi
                    </label>

                    <textarea
                        id="prestasiDeskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Deskripsi prestasi..."
                    ></textarea>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closePrestasiModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                >
                    Simpan Prestasi
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const prestasiModal =
    document.getElementById('prestasiModal');

const prestasiForm =
    document.getElementById('prestasiForm');

const prestasiId =
    document.getElementById('prestasiId');


function openPrestasiModal() {

    prestasiForm.reset();

    prestasiId.value = '';

    document.getElementById(
        'prestasiModalTitle'
    ).textContent = 'Tambah Prestasi';

    prestasiModal.style.display = 'flex';

}


function closePrestasiModal() {

    prestasiModal.style.display = 'none';

}


async function editPrestasi(id) {

    try {

        const response =
            await fetch(`/admin/prestasi/${id}`);

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

        prestasiId.value = data.id;

        document.getElementById(
            'prestasiJudul'
        ).value = data.judul ?? '';

        document.getElementById(
            'prestasiKategori'
        ).value = data.kategori ?? '';

        document.getElementById(
            'prestasiTingkat'
        ).value = data.tingkat ?? '';

        document.getElementById(
            'prestasiPeraih'
        ).value = data.peraih ?? '';

        document.getElementById(
            'prestasiPenyelenggara'
        ).value = data.penyelenggara ?? '';

        document.getElementById(
            'prestasiTahun'
        ).value = data.tahun ?? '';

        document.getElementById(
            'prestasiDeskripsi'
        ).value = data.deskripsi ?? '';


        document.getElementById(
            'prestasiModalTitle'
        ).textContent = 'Edit Prestasi';


        prestasiModal.style.display = 'flex';

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data prestasi gagal diambil.'
        });

    }

}


prestasiForm.addEventListener(
    'submit',
    async function(event) {

        event.preventDefault();

        const id = prestasiId.value;

        const formData =
            new FormData(this);

        let url = '/admin/prestasi';

        if (id) {

            url = `/admin/prestasi/${id}`;

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

                        'Accept': 'application/json'

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


            closePrestasiModal();

            setTimeout(() => {
                window.location.reload();
            }, 1500);

        } catch (error) {

            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Tidak dapat terhubung ke server.'
            });

        }

    }
);


async function deletePrestasi(id) {

    const confirmation =
        await Swal.fire({

            title: 'Hapus prestasi?',

            text: 'Data prestasi yang dihapus tidak dapat dikembalikan.',

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
                `/admin/prestasi/${id}`,
                {

                    method: 'DELETE',

                    headers: {

                        'X-CSRF-TOKEN':
                            document
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                )
                                .getAttribute('content'),

                        'Accept': 'application/json'

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
            window.location.reload();
        }, 1500);

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Tidak dapat terhubung ke server.'
        });

    }

}

</script>

@endpush