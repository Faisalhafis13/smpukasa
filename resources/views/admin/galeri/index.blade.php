@extends('admin.layouts.app')

@section('title', 'Galeri - Admin')
@section('page-title', 'Galeri')

@section('content')

<div class="admin-page-header">

    <div>
        <span class="admin-eyebrow">KONTEN SEKOLAH</span>

        <h1>Galeri</h1>

        <p>
            Kelola dokumentasi kegiatan dan lingkungan sekolah.
        </p>
    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openGaleriModal()">

        + Tambah Foto

    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>
            <h2>Dokumentasi Sekolah</h2>

            <p>
                Koleksi foto yang ditampilkan pada website sekolah.
            </p>
        </div>

    </div>

    @include('admin.layouts.page-size', ['paginator' => $galeris])
    <form method="GET" action="{{ route('admin.galeri.index') }}" class="admin-search-bar">
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari judul, kategori, atau deskripsi..."
            aria-label="Cari galeri"
        >

        <button type="submit" class="admin-btn admin-btn-primary">
            Cari
        </button>

        @if ($search)
            <a href="{{ route('admin.galeri.index') }}" class="admin-btn admin-btn-secondary">
                Reset
            </a>
        @endif
    </form>


    <div class="admin-gallery-grid">

        @forelse ($galeris as $galeri)

            <div class="admin-gallery-card">

                <div class="admin-gallery-image">

                    <img
                        src="{{ asset('storage/' . $galeri->gambar) }}"
                        alt="{{ $galeri->judul }}"
                    >

                </div>


                <div class="admin-gallery-body">

                    <span class="admin-gallery-category">
                        {{ $galeri->kategori ?: 'Dokumentasi' }}
                    </span>

                    <h3>
                        {{ $galeri->judul }}
                    </h3>

                    @if ($galeri->tanggal)

                        <small>
                            {{ $galeri->tanggal->format('d M Y') }}
                        </small>

                    @endif


                    <div class="admin-gallery-actions">

                        <button
                            type="button"
                            class="admin-btn admin-btn-secondary admin-btn-sm"
                            onclick="editGaleri({{ $galeri->id }})"
                        >
                            Edit
                        </button>

                        <button
                            type="button"
                            class="admin-btn admin-btn-danger admin-btn-sm"
                            onclick="deleteGaleri({{ $galeri->id }})"
                        >
                            Hapus
                        </button>

                    </div>

                </div>

            </div>

        @empty

            <div style="
                grid-column: 1 / -1;
                text-align: center;
                padding: 60px 20px;
            ">

                <h3>
                    {{ $search ? 'Tidak ada foto yang cocok' : 'Belum ada foto' }}
                </h3>

                <p style="color:#64748b;">
                    {{ $search ? 'Coba kata kunci lain.' : 'Tambahkan dokumentasi pertama sekolah.' }}
                </p>

            </div>

        @endforelse

    </div>

    @include('admin.layouts.pagination', ['paginator' => $galeris])

</div>


{{-- MODAL --}}

<div
    class="admin-modal"
    id="galeriModal"
    style="display:none;"
>

    <div
        class="admin-modal-overlay"
        onclick="closeGaleriModal()"
    ></div>


    <div class="admin-modal-dialog">

        <div class="admin-modal-header">

            <div>

                <h2 id="galeriModalTitle">
                    Tambah Foto
                </h2>

                <p>
                    Tambahkan dokumentasi kegiatan sekolah.
                </p>

            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closeGaleriModal()"
            >
                ×
            </button>

        </div>


        <form
            id="galeriForm"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                id="galeriId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="galeriJudul">
                        Judul Foto
                    </label>

                    <input
                        type="text"
                        id="galeriJudul"
                        name="judul"
                        required
                        placeholder="Contoh: Upacara Bendera"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="galeriKategori">
                        Kategori
                    </label>

                    <input
                        type="text"
                        id="galeriKategori"
                        name="kategori"
                        placeholder="Contoh: Kegiatan"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="galeriTanggal">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        id="galeriTanggal"
                        name="tanggal"
                    >

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="galeriGambar">
                        Foto
                    </label>

                    <input
                        type="file"
                        id="galeriGambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="galeriDeskripsi">
                        Deskripsi
                    </label>

                    <textarea
                        id="galeriDeskripsi"
                        name="deskripsi"
                        rows="4"
                        placeholder="Deskripsi foto..."
                    ></textarea>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closeGaleriModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                >
                    Simpan Foto
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const galeriModal =
    document.getElementById('galeriModal');

const galeriForm =
    document.getElementById('galeriForm');

const galeriId =
    document.getElementById('galeriId');


function openGaleriModal() {

    galeriForm.reset();

    galeriId.value = '';

    document.getElementById(
        'galeriModalTitle'
    ).textContent = 'Tambah Foto';

    galeriModal.style.display = 'flex';

}


function closeGaleriModal() {

    galeriModal.style.display = 'none';

}


async function editGaleri(id) {

    const response =
        await fetch(`/admin/galeri/${id}`);

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

    galeriId.value = data.id;

    document.getElementById(
        'galeriJudul'
    ).value = data.judul ?? '';

    document.getElementById(
        'galeriKategori'
    ).value = data.kategori ?? '';

    document.getElementById(
        'galeriTanggal'
    ).value = data.tanggal ?? '';

    document.getElementById(
        'galeriDeskripsi'
    ).value = data.deskripsi ?? '';


    document.getElementById(
        'galeriModalTitle'
    ).textContent = 'Edit Foto';


    galeriModal.style.display = 'flex';

}


galeriForm.addEventListener(
    'submit',
    async function(event) {

        event.preventDefault();

        const id = galeriId.value;

        const formData =
            new FormData(this);

        let url = '/admin/galeri';

        if (id) {

            url = `/admin/galeri/${id}`;

            formData.append(
                '_method',
                'PUT'
            );

        }


        const response = await fetch(url, {

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


        closeGaleriModal();

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

    }
);


async function deleteGaleri(id) {

    const confirmation =
        await Swal.fire({

            title: 'Hapus foto?',

            text: 'Foto yang dihapus tidak dapat dikembalikan.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Ya, Hapus',

            cancelButtonText: 'Batal'

        });


    if (!confirmation.isConfirmed) {
        return;
    }


    const response =
        await fetch(
            `/admin/galeri/${id}`,
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
        window.AdminAjax.refresh();
    }, 1500);

}

</script>

@endpush