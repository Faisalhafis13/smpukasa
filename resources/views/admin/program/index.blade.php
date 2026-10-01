@extends('admin.layouts.app')

@section('title', 'Program & Ekstrakurikuler - Admin')
@section('page-title', 'Program & Ekstrakurikuler')

@section('content')

<div class="admin-page-header">

    <div>

        <span class="admin-eyebrow">
            AKADEMIK
        </span>

        <h1>Program & Ekstrakurikuler</h1>

        <p>
            Kelola program unggulan dan kegiatan ekstrakurikuler sekolah.
        </p>

    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openProgramModal()"
    >
        + Tambah Program
    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>

            <h2>Daftar Program</h2>

            <p>
                Program unggulan dan ekstrakurikuler SMP Unggulan Karangsawo.
            </p>

        </div>

    </div>

    @include('admin.layouts.page-size', ['paginator' => $programs])
    <form method="GET" action="{{ route('admin.program.index') }}" class="admin-search-bar">
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari nama, jenis, pembina, atau jadwal..."
            aria-label="Cari program"
        >
        <button type="submit" class="admin-btn admin-btn-primary">Cari</button>
        @if ($search)
            <a href="{{ route('admin.program.index') }}" class="admin-btn admin-btn-secondary">Reset</a>
        @endif
    </form>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>

                    <th width="60">No</th>

                    <th width="90">Gambar</th>

                    <th>Nama</th>

                    <th>Jenis</th>

                    <th>Pembina</th>

                    <th>Jadwal</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($programs as $index => $program)

                    <tr>

                        <td>
                            {{ $programs->firstItem() + $index }}
                        </td>


                        <td>

                            @if ($program->gambar)

                                <img
                                    src="{{ asset('storage/' . $program->gambar) }}"
                                    alt="{{ $program->nama }}"
                                    style="
                                        width:70px;
                                        height:50px;
                                        object-fit:cover;
                                        border-radius:8px;
                                    "
                                >

                            @else

                                <div class="admin-image-placeholder" aria-hidden="true"></div>

                            @endif

                        </td>


                        <td>

                            <strong>
                                {{ $program->nama }}
                            </strong>

                        </td>


                        <td>

                            @if ($program->jenis === 'Program Unggulan')

                                <span class="admin-status-badge">
                                    Program Unggulan
                                </span>

                            @else

                                <span
                                    class="admin-status-badge"
                                    style="
                                        background:#eff6ff;
                                        color:#1d4ed8;
                                    "
                                >
                                    Ekstrakurikuler
                                </span>

                            @endif

                        </td>


                        <td>
                            {{ $program->pembina ?: '-' }}
                        </td>


                        <td>
                            {{ $program->jadwal ?: '-' }}
                        </td>


                        <td>

                            <div style="
                                display:flex;
                                gap:8px;
                            ">

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-secondary admin-btn-sm"
                                    onclick="editProgram({{ $program->id }})"
                                >
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-danger admin-btn-sm"
                                    onclick="deleteProgram({{ $program->id }})"
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

                            <strong>{{ $search ? 'Tidak ada program yang cocok' : 'Belum ada program' }}</strong>

                            <p style="
                                color:#64748b;
                                margin-top:5px;
                            ">
                                {{ $search ? 'Coba kata kunci lain.' : 'Tambahkan program atau ekstrakurikuler pertama.' }}
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @include('admin.layouts.pagination', ['paginator' => $programs])

</div>


{{-- MODAL --}}

<div
    class="admin-modal"
    id="programModal"
    style="display:none;"
>

    <div
        class="admin-modal-overlay"
        onclick="closeProgramModal()"
    ></div>


    <div class="admin-modal-content">

        <div class="admin-modal-header">

            <div>

                <h2 id="programModalTitle">
                    Tambah Program
                </h2>

                <p>
                    Lengkapi informasi program sekolah.
                </p>

            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closeProgramModal()"
            >
                ×
            </button>

        </div>


        <form
            id="programForm"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                id="programId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="programNama">
                        Nama Program
                    </label>

                    <input
                        type="text"
                        id="programNama"
                        name="nama"
                        required
                        placeholder="Contoh: Tahfidz Al-Qur'an"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="programJenis">
                        Jenis
                    </label>

                    <select
                        id="programJenis"
                        name="jenis"
                        required
                    >

                        <option value="">
                            Pilih Jenis
                        </option>

                        <option value="Program Unggulan">
                            Program Unggulan
                        </option>

                        <option value="Ekstrakurikuler">
                            Ekstrakurikuler
                        </option>

                    </select>

                </div>


                <div class="admin-form-group">

                    <label for="programPembina">
                        Pembina
                    </label>

                    <input
                        type="text"
                        id="programPembina"
                        name="pembina"
                        placeholder="Nama pembina"
                    >

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="programJadwal">
                        Jadwal
                    </label>

                    <input
                        type="text"
                        id="programJadwal"
                        name="jadwal"
                        placeholder="Contoh: Senin & Rabu, 14.00 - 16.00"
                    >

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="programGambar">
                        Gambar
                    </label>

                    <input
                        type="file"
                        id="programGambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="programDeskripsi">
                        Deskripsi
                    </label>

                    <textarea
                        id="programDeskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Deskripsi program..."
                    ></textarea>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closeProgramModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                >
                    Simpan Program
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const programModal =
    document.getElementById('programModal');

const programForm =
    document.getElementById('programForm');

const programId =
    document.getElementById('programId');


function openProgramModal()
{
    programForm.reset();

    programId.value = '';

    document.getElementById(
        'programModalTitle'
    ).textContent = 'Tambah Program';

    programModal.style.display = 'flex';
}


function closeProgramModal()
{
    programModal.style.display = 'none';
}


async function editProgram(id)
{
    try {

        const response =
            await fetch(`/admin/program/${id}`);

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

        programId.value = data.id;

        document.getElementById(
            'programNama'
        ).value = data.nama ?? '';

        document.getElementById(
            'programJenis'
        ).value = data.jenis ?? '';

        document.getElementById(
            'programPembina'
        ).value = data.pembina ?? '';

        document.getElementById(
            'programJadwal'
        ).value = data.jadwal ?? '';

        document.getElementById(
            'programDeskripsi'
        ).value = data.deskripsi ?? '';

        document.getElementById(
            'programGambar'
        ).value = '';


        document.getElementById(
            'programModalTitle'
        ).textContent = 'Edit Program';

        programModal.style.display = 'flex';

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data program gagal diambil.'
        });

    }
}


programForm.addEventListener(
    'submit',
    async function(event)
    {
        event.preventDefault();

        const id = programId.value;

        const formData =
            new FormData(this);

        let url = '/admin/program';

        if (id) {

            url = `/admin/program/${id}`;

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


            closeProgramModal();

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


async function deleteProgram(id)
{
    const confirmation =
        await Swal.fire({

            title: 'Hapus program?',

            text:
                'Data program yang dihapus tidak dapat dikembalikan.',

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
                `/admin/program/${id}`,
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