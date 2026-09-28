@extends('admin.layouts.app')

@section('title', 'Guru - Admin')
@section('page-title', 'Guru')

@section('content')

<div class="admin-page-header">

    <div>

        <span class="admin-eyebrow">
            DATA AKADEMIK
        </span>

        <h1>Guru</h1>

        <p>
            Kelola data guru dan tenaga pendidik sekolah.
        </p>

    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openGuruModal()"
    >
        + Tambah Guru
    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>

            <h2>Daftar Guru</h2>

            <p>
                Data guru dan tenaga pendidik SMP Unggulan Karangsawo.
            </p>

        </div>

    </div>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th width="80">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Mata Pelajaran</th>
                    <th>Pendidikan</th>
                    <th width="150">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($gurus as $index => $guru)

                    <tr>

                        <td>
                            {{ $index + 1 }}
                        </td>

                        <td>

                            @if ($guru->foto)

                                <img
                                    src="{{ asset('storage/' . $guru->foto) }}"
                                    alt="{{ $guru->nama }}"
                                    style="
                                        width:55px;
                                        height:55px;
                                        object-fit:cover;
                                        border-radius:50%;
                                    "
                                >

                            @else

                                <div style="
                                    width:55px;
                                    height:55px;
                                    border-radius:50%;
                                    background:#dcfce7;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:22px;
                                ">
                                    👨‍🏫
                                </div>

                            @endif

                        </td>

                        <td>

                            <strong>
                                {{ $guru->nama }}
                            </strong>

                        </td>

                        <td>
                            {{ $guru->jabatan ?: '-' }}
                        </td>

                        <td>
                            {{ $guru->mata_pelajaran ?: '-' }}
                        </td>

                        <td>
                            {{ $guru->pendidikan ?: '-' }}
                        </td>

                        <td>

                            <div style="
                                display:flex;
                                gap:8px;
                            ">

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-secondary admin-btn-sm"
                                    onclick="editGuru({{ $guru->id }})"
                                >
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-danger admin-btn-sm"
                                    onclick="deleteGuru({{ $guru->id }})"
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
                                👨‍🏫
                            </div>

                            <strong>
                                Belum ada data guru
                            </strong>

                            <p style="
                                color:#64748b;
                                margin-top:5px;
                            ">
                                Tambahkan data guru pertama.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL GURU --}}

<div
    class="admin-modal"
    id="guruModal"
    style="display:none;"
>

    <div
        class="admin-modal-overlay"
        onclick="closeGuruModal()"
    ></div>


    <div class="admin-modal-content">

        <div class="admin-modal-header">

            <div>

                <h2 id="guruModalTitle">
                    Tambah Guru
                </h2>

                <p>
                    Lengkapi informasi guru.
                </p>

            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closeGuruModal()"
            >
                ×
            </button>

        </div>


        <form
            id="guruForm"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                id="guruId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="guruNama">
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        id="guruNama"
                        name="nama"
                        required
                        placeholder="Nama lengkap guru"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="guruJabatan">
                        Jabatan
                    </label>

                    <input
                        type="text"
                        id="guruJabatan"
                        name="jabatan"
                        placeholder="Contoh: Guru Mata Pelajaran"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="guruMapel">
                        Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        id="guruMapel"
                        name="mata_pelajaran"
                        placeholder="Contoh: Matematika"
                    >

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="guruPendidikan">
                        Pendidikan
                    </label>

                    <input
                        type="text"
                        id="guruPendidikan"
                        name="pendidikan"
                        placeholder="Contoh: S1 Pendidikan Matematika"
                    >

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="guruFoto">
                        Foto Guru
                    </label>

                    <input
                        type="file"
                        id="guruFoto"
                        name="foto"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="guruDeskripsi">
                        Deskripsi
                    </label>

                    <textarea
                        id="guruDeskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Deskripsi singkat guru..."
                    ></textarea>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closeGuruModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                >
                    Simpan Guru
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const guruModal =
    document.getElementById('guruModal');

const guruForm =
    document.getElementById('guruForm');

const guruId =
    document.getElementById('guruId');


function openGuruModal()
{
    guruForm.reset();

    guruId.value = '';

    document.getElementById(
        'guruModalTitle'
    ).textContent = 'Tambah Guru';

    guruModal.style.display = 'flex';
}


function closeGuruModal()
{
    guruModal.style.display = 'none';
}


async function editGuru(id)
{
    try {

        const response =
            await fetch(`/admin/guru/${id}`);

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

        guruId.value = data.id;

        document.getElementById(
            'guruNama'
        ).value = data.nama ?? '';

        document.getElementById(
            'guruJabatan'
        ).value = data.jabatan ?? '';

        document.getElementById(
            'guruMapel'
        ).value = data.mata_pelajaran ?? '';

        document.getElementById(
            'guruPendidikan'
        ).value = data.pendidikan ?? '';

        document.getElementById(
            'guruDeskripsi'
        ).value = data.deskripsi ?? '';

        document.getElementById(
            'guruFoto'
        ).value = '';


        document.getElementById(
            'guruModalTitle'
        ).textContent = 'Edit Guru';

        guruModal.style.display = 'flex';

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data guru gagal diambil.'
        });

    }
}


guruForm.addEventListener(
    'submit',
    async function(event)
    {
        event.preventDefault();

        const id = guruId.value;

        const formData =
            new FormData(this);

        let url = '/admin/guru';

        if (id) {

            url = `/admin/guru/${id}`;

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


            closeGuruModal();

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


async function deleteGuru(id)
{
    const confirmation =
        await Swal.fire({

            title: 'Hapus data guru?',

            text:
                'Data guru yang dihapus tidak dapat dikembalikan.',

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
                `/admin/guru/${id}`,
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
            window.location.reload();
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