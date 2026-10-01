@extends('admin.layouts.app')

@section('title', 'Berita - Admin')
@section('page-title', 'Berita')

@section('content')

<div class="admin-page-header">

    <div>
        <span class="admin-eyebrow">KONTEN SEKOLAH</span>

        <h1>Berita</h1>

        <p>
            Kelola berita dan informasi terbaru SMP Unggulan Karangsawo.
        </p>
    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openBeritaModal()">

        + Tambah Berita

    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>
            <h2>Daftar Berita</h2>

            <p>
                Semua berita yang tersimpan dalam sistem.
            </p>
        </div>

    </div>

    @include('admin.layouts.page-size', ['paginator' => $beritas])
    <form method="GET" action="{{ route('admin.berita.index') }}" class="admin-search-bar">
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari judul, kategori, atau isi berita..."
            aria-label="Cari berita"
        >

        <button type="submit" class="admin-btn admin-btn-primary">
            Cari
        </button>

        @if ($search)
            <a href="{{ route('admin.berita.index') }}" class="admin-btn admin-btn-secondary">
                Reset
            </a>
        @endif
    </form>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th width="90">Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="150">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($beritas as $index => $berita)

                    <tr>

                        <td>
                            {{ $beritas->firstItem() + $index }}
                        </td>

                        <td>

                            @if ($berita->gambar)

                                <img
                                    src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ $berita->judul }}"
                                    style="
                                        width: 70px;
                                        height: 50px;
                                        object-fit: cover;
                                        border-radius: 8px;
                                    "
                                >

                            @else

                                <div class="admin-image-placeholder" aria-hidden="true"></div>

                            @endif

                        </td>

                        <td>

                            <strong>
                                {{ $berita->judul }}
                            </strong>

                            @if ($berita->ringkasan)

                                <small style="
                                    display: block;
                                    margin-top: 5px;
                                    color: #64748b;
                                ">
                                    {{ Str::limit($berita->ringkasan, 80) }}
                                </small>

                            @endif

                        </td>

                        <td>

                            {{ $berita->kategori ?: '-' }}

                        </td>

                        <td>

                            @if ($berita->status === 'published')

                                <span class="admin-badge admin-badge-success">
                                    Published
                                </span>

                            @else

                                <span class="admin-badge admin-badge-warning">
                                    Draft
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $berita->tanggal_publish
                                ? $berita->tanggal_publish->format('d M Y')
                                : '-' }}

                        </td>

                        <td>

                            <div style="display:flex; gap:8px;">

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-secondary admin-btn-sm"
                                    onclick="editBerita({{ $berita->id }})">

                                    Edit

                                </button>

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-danger admin-btn-sm"
                                    onclick="deleteBerita({{ $berita->id }})">

                                    Hapus

                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            style="text-align:center; padding:50px;"
                        >

                            <strong>
                                {{ $search ? 'Tidak ada berita yang cocok' : 'Belum ada berita' }}
                            </strong>

                            <p style="color:#64748b; margin-top:5px;">
                                {{ $search ? 'Coba kata kunci lain.' : 'Tambahkan berita pertama untuk website sekolah.' }}
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @include('admin.layouts.pagination', ['paginator' => $beritas])

</div>


{{-- MODAL --}}

<div
    class="admin-modal"
    id="beritaModal"
    style="display:none;"
>

    <div class="admin-modal-overlay" onclick="closeBeritaModal()"></div>


    <div class="admin-modal-dialog">

        <div class="admin-modal-header">

            <div>
                <h2 id="beritaModalTitle">
                    Tambah Berita
                </h2>

                <p>
                    Lengkapi informasi berita sekolah.
                </p>
            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closeBeritaModal()"
            >
                ×
            </button>

        </div>


        <form
            id="beritaForm"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                id="beritaId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="judul">
                        Judul Berita
                    </label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        required
                        placeholder="Masukkan judul berita"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="kategori">
                        Kategori
                    </label>

                    <input
                        type="text"
                        id="kategori"
                        name="kategori"
                        placeholder="Contoh: Prestasi"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="tanggal_publish">
                        Tanggal Publish
                    </label>

                    <input
                        type="date"
                        id="tanggal_publish"
                        name="tanggal_publish"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="status">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                    >

                        <option value="draft">
                            Draft
                        </option>

                        <option value="published">
                            Published
                        </option>

                    </select>

                </div>


                <div class="admin-form-group">

                    <label for="gambar">
                        Gambar
                    </label>

                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Maksimal 2 MB.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="ringkasan">
                        Ringkasan
                    </label>

                    <textarea
                        id="ringkasan"
                        name="ringkasan"
                        rows="3"
                        placeholder="Ringkasan singkat berita"
                    ></textarea>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="isi">
                        Isi Berita
                    </label>

                    <textarea
                        id="isi"
                        name="isi"
                        rows="8"
                        required
                        placeholder="Tuliskan isi berita..."
                    ></textarea>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closeBeritaModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                    id="beritaSubmitButton"
                >
                    Simpan Berita
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const beritaModal = document.getElementById('beritaModal');
const beritaForm = document.getElementById('beritaForm');
const beritaId = document.getElementById('beritaId');


function openBeritaModal() {

    beritaForm.reset();

    beritaId.value = '';

    document.getElementById('beritaModalTitle').textContent =
        'Tambah Berita';

    document.getElementById('beritaSubmitButton').textContent =
        'Simpan Berita';

    beritaModal.style.display = 'flex';

}


function closeBeritaModal() {

    beritaModal.style.display = 'none';

}


async function editBerita(id) {

    try {

        const response = await fetch(
            `/admin/berita/${id}`
        );

        const result = await response.json();

        if (!result.success) {

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: result.message
            });

            return;
        }


        const data = result.data;

        beritaId.value = data.id;

        document.getElementById('judul').value =
            data.judul ?? '';

        document.getElementById('kategori').value =
            data.kategori ?? '';

        document.getElementById('ringkasan').value =
            data.ringkasan ?? '';

        document.getElementById('isi').value =
            data.isi ?? '';

        document.getElementById('tanggal_publish').value =
            data.tanggal_publish ?? '';

        document.getElementById('status').value =
            data.status ?? 'draft';


        document.getElementById('beritaModalTitle').textContent =
            'Edit Berita';

        document.getElementById('beritaSubmitButton').textContent =
            'Perbarui Berita';

        beritaModal.style.display = 'flex';

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data berita gagal diambil.'
        });

    }

}


beritaForm.addEventListener('submit', async function (event) {

    event.preventDefault();


    const id = beritaId.value;

    const formData = new FormData(this);


    let url = '/admin/berita';

    if (id) {

        url = `/admin/berita/${id}`;

        formData.append('_method', 'PUT');

    }


    try {

        const response = await fetch(url, {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).getAttribute('content'),

                'Accept': 'application/json'
            },

            body: formData

        });


        const result = await response.json();


        if (!response.ok) {

            if (result.errors) {

                const messages = Object.values(result.errors)
                    .flat()
                    .join('<br>');

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: messages
                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: result.message ?? 'Terjadi kesalahan.'
                });

            }

            return;

        }


        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: result.message,
            timer: 1500,
            showConfirmButton: false
        });


        closeBeritaModal();

        setTimeout(() => {
            window.AdminAjax.refresh();
        }, 1500);


    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Tidak dapat terhubung ke server.'
        });

    }

});


async function deleteBerita(id) {

    const confirmation = await Swal.fire({

        title: 'Hapus berita?',

        text: 'Data berita yang dihapus tidak dapat dikembalikan.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonText: 'Ya, Hapus',

        cancelButtonText: 'Batal'

    });


    if (!confirmation.isConfirmed) {
        return;
    }


    try {

        const response = await fetch(
            `/admin/berita/${id}`,
            {

                method: 'DELETE',

                headers: {

                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content'),

                    'Accept': 'application/json'

                }

            }
        );


        const result = await response.json();


        if (!response.ok) {

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: result.message ?? 'Berita gagal dihapus.'
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
            text: 'Tidak dapat terhubung ke server.'
        });

    }

}

</script>

@endpush