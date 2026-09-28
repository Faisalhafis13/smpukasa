@extends('admin.layouts.app')

@section('title', 'Fasilitas - Admin')
@section('page-title', 'Fasilitas')

@section('content')

<div class="admin-page-header">

    <div>
        <span class="admin-eyebrow">
            KONTEN SEKOLAH
        </span>

        <h1>Fasilitas</h1>

        <p>
            Kelola informasi fasilitas yang tersedia di sekolah.
        </p>
    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openFasilitasModal()"
    >
        + Tambah Fasilitas
    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>
            <h2>Daftar Fasilitas</h2>

            <p>
                Informasi fasilitas SMP Unggulan Karangsawo.
            </p>
        </div>

    </div>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th width="90">Gambar</th>
                    <th>Nama Fasilitas</th>
                    <th>Lokasi</th>
                    <th>Kondisi</th>
                    <th width="150">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($fasilitas as $index => $item)

                    <tr>

                        <td>
                            {{ $index + 1 }}
                        </td>

                        <td>

                            @if ($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->nama }}"
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
                                    🏫
                                </div>

                            @endif

                        </td>

                        <td>

                            <strong>
                                {{ $item->nama }}
                            </strong>

                        </td>

                        <td>
                            {{ $item->lokasi ?: '-' }}
                        </td>

                        <td>

                            @if ($item->kondisi)

                                <span class="admin-status-badge">
                                    {{ $item->kondisi }}
                                </span>

                            @else
                                -
                            @endif

                        </td>

                        <td>

                            <div style="
                                display:flex;
                                gap:8px;
                            ">

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-secondary admin-btn-sm"
                                    onclick="editFasilitas({{ $item->id }})"
                                >
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-danger admin-btn-sm"
                                    onclick="deleteFasilitas({{ $item->id }})"
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

                            <div style="
                                font-size:45px;
                                margin-bottom:10px;
                            ">
                                🏫
                            </div>

                            <strong>
                                Belum ada fasilitas
                            </strong>

                            <p style="
                                color:#64748b;
                                margin-top:5px;
                            ">
                                Tambahkan fasilitas pertama.
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
    id="fasilitasModal"
    style="display:none;"
>

    <div
        class="admin-modal-overlay"
        onclick="closeFasilitasModal()"
    ></div>


    <div class="admin-modal-content">

        <div class="admin-modal-header">

            <div>

                <h2 id="fasilitasModalTitle">
                    Tambah Fasilitas
                </h2>

                <p>
                    Lengkapi informasi fasilitas sekolah.
                </p>

            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closeFasilitasModal()"
            >
                ×
            </button>

        </div>


        <form
            id="fasilitasForm"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                id="fasilitasId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="fasilitasNama">
                        Nama Fasilitas
                    </label>

                    <input
                        type="text"
                        id="fasilitasNama"
                        name="nama"
                        required
                        placeholder="Contoh: Laboratorium Komputer"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="fasilitasLokasi">
                        Lokasi
                    </label>

                    <input
                        type="text"
                        id="fasilitasLokasi"
                        name="lokasi"
                        placeholder="Contoh: Gedung Utama Lantai 2"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="fasilitasKondisi">
                        Kondisi
                    </label>

                    <select
                        id="fasilitasKondisi"
                        name="kondisi"
                    >

                        <option value="">
                            Pilih Kondisi
                        </option>

                        <option value="Baik">
                            Baik
                        </option>

                        <option value="Cukup Baik">
                            Cukup Baik
                        </option>

                        <option value="Perlu Perbaikan">
                            Perlu Perbaikan
                        </option>

                    </select>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="fasilitasGambar">
                        Gambar
                    </label>

                    <input
                        type="file"
                        id="fasilitasGambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="fasilitasDeskripsi">
                        Deskripsi
                    </label>

                    <textarea
                        id="fasilitasDeskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Deskripsi fasilitas..."
                    ></textarea>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closeFasilitasModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                >
                    Simpan Fasilitas
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const fasilitasModal =
    document.getElementById('fasilitasModal');

const fasilitasForm =
    document.getElementById('fasilitasForm');

const fasilitasId =
    document.getElementById('fasilitasId');


function openFasilitasModal() {

    fasilitasForm.reset();

    fasilitasId.value = '';

    document.getElementById(
        'fasilitasModalTitle'
    ).textContent = 'Tambah Fasilitas';

    fasilitasModal.style.display = 'flex';
}


function closeFasilitasModal() {

    fasilitasModal.style.display = 'none';
}


async function editFasilitas(id) {

    try {

        const response =
            await fetch(`/admin/fasilitas/${id}`);

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

        fasilitasId.value = data.id;

        document.getElementById(
            'fasilitasNama'
        ).value = data.nama ?? '';

        document.getElementById(
            'fasilitasLokasi'
        ).value = data.lokasi ?? '';

        document.getElementById(
            'fasilitasKondisi'
        ).value = data.kondisi ?? '';

        document.getElementById(
            'fasilitasDeskripsi'
        ).value = data.deskripsi ?? '';

        document.getElementById(
            'fasilitasGambar'
        ).value = '';


        document.getElementById(
            'fasilitasModalTitle'
        ).textContent = 'Edit Fasilitas';

        fasilitasModal.style.display = 'flex';

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data fasilitas gagal diambil.'
        });

    }
}


fasilitasForm.addEventListener(
    'submit',
    async function (event) {

        event.preventDefault();

        const id = fasilitasId.value;

        const formData =
            new FormData(this);

        let url = '/admin/fasilitas';

        if (id) {

            url = `/admin/fasilitas/${id}`;

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


            closeFasilitasModal();

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


async function deleteFasilitas(id) {

    const confirmation =
        await Swal.fire({

            title: 'Hapus fasilitas?',

            text: 'Data fasilitas yang dihapus tidak dapat dikembalikan.',

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
                `/admin/fasilitas/${id}`,
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