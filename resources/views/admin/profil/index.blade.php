@extends('admin.layouts.app')

@section('title', 'Profil Sekolah - Admin')

@section('page-title', 'Profil Sekolah')

@section('content')

    <div class="admin-page-header admin-page-header-row">

        <div>

            <span class="admin-eyebrow">
                KONTEN SEKOLAH
            </span>

            <h1>
                Profil Sekolah
            </h1>

            <p>
                Kelola informasi utama SMP Unggulan Karangsawo.
            </p>

        </div>

        <button
            type="button"
            class="admin-btn admin-btn-primary"
            id="btnTambahProfil">

            <span>＋</span>
            Tambah Profil

        </button>

    </div>


    <div class="admin-panel">

        <div class="admin-panel-header">

            <div>
                <h2>Data Profil Sekolah</h2>

                <p>
                    Informasi yang ditampilkan pada website sekolah.
                </p>
            </div>

        </div>

        <form method="GET" action="{{ route('admin.profil.index') }}" class="admin-search-bar">
            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama sekolah, kepala sekolah, email..."
                aria-label="Cari profil sekolah"
            >

            <button type="submit" class="admin-btn admin-btn-primary">
                Cari
            </button>

            @if ($search)
                <a href="{{ route('admin.profil.index') }}" class="admin-btn admin-btn-secondary">
                    Reset
                </a>
            @endif
        </form>


        <div class="admin-table-wrapper">

            <table class="admin-table">

                <thead>

                    <tr>
                        <th width="60">No</th>
                        <th>Nama Sekolah</th>
                        <th>Kepala Sekolah</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th width="180">Aksi</th>
                    </tr>

                </thead>

                <tbody id="profilTableBody">

                    @forelse ($profils as $index => $profil)

                        <tr id="profil-row-{{ $profil->id }}">

                            <td>
                                {{ $profils->firstItem() + $index }}
                            </td>

                            <td>

                                <div class="table-primary-text">
                                    {{ $profil->nama_sekolah }}
                                </div>

                                <div class="table-secondary-text">
                                    {{ $profil->npsn ?: 'NPSN belum diisi' }}
                                </div>

                            </td>

                            <td>
                                {{ $profil->kepala_sekolah ?: '-' }}
                            </td>

                            <td>
                                {{ $profil->email ?: '-' }}
                            </td>

                            <td>
                                {{ $profil->telepon ?: '-' }}
                            </td>

                            <td>

                                <div class="table-actions">

                                    <button
                                        type="button"
                                        class="admin-btn admin-btn-sm admin-btn-edit btn-edit-profil"
                                        data-id="{{ $profil->id }}">

                                        Edit

                                    </button>

                                    <button
                                        type="button"
                                        class="admin-btn admin-btn-sm admin-btn-delete btn-delete-profil"
                                        data-id="{{ $profil->id }}">

                                        Hapus

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="admin-empty">

                                    <div class="admin-empty-icon">
                                        🏫
                                    </div>

                                    <h3>
                                        Belum ada data profil
                                    </h3>

                                    <p>
                                        Tambahkan profil sekolah untuk mulai mengisi informasi.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($profils->hasPages())
            <div class="admin-pagination">
                {{ $profils->onEachSide(1)->links() }}
            </div>
        @endif

    </div>


    {{-- MODAL PROFIL --}}

    <div
        class="admin-modal"
        id="profilModal"
        aria-hidden="true">

        <div class="admin-modal-overlay" id="profilModalOverlay"></div>

        <div class="admin-modal-dialog">

            <div class="admin-modal-header">

                <div>

                    <span class="admin-eyebrow">
                        FORM DATA
                    </span>

                    <h2 id="profilModalTitle">
                        Tambah Profil
                    </h2>

                </div>

                <button
                    type="button"
                    class="admin-modal-close"
                    id="btnCloseProfilModal">

                    ×

                </button>

            </div>


            <form id="profilForm">

                <input
                    type="hidden"
                    id="profilId"
                    name="id">


                <div class="admin-modal-body">

                    <div class="admin-form-section">

                        <h3>
                            Informasi Sekolah
                        </h3>

                        <div class="admin-form-grid">

                            <div class="admin-form-group full">

                                <label for="nama_sekolah">
                                    Nama Sekolah <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="nama_sekolah"
                                    name="nama_sekolah"
                                    placeholder="Masukkan nama sekolah"
                                    required>

                            </div>


                            <div class="admin-form-group">

                                <label for="npsn">
                                    NPSN
                                </label>

                                <input
                                    type="text"
                                    id="npsn"
                                    name="npsn"
                                    placeholder="Masukkan NPSN">

                            </div>


                            <div class="admin-form-group">

                                <label for="telepon">
                                    Telepon
                                </label>

                                <input
                                    type="text"
                                    id="telepon"
                                    name="telepon"
                                    placeholder="Nomor telepon">

                            </div>


                            <div class="admin-form-group">

                                <label for="email">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Email sekolah">

                            </div>


                            <div class="admin-form-group">

                                <label for="kepala_sekolah">
                                    Kepala Sekolah
                                </label>

                                <input
                                    type="text"
                                    id="kepala_sekolah"
                                    name="kepala_sekolah"
                                    placeholder="Nama kepala sekolah">

                            </div>


                            <div class="admin-form-group full">

                                <label for="alamat">
                                    Alamat
                                </label>

                                <textarea
                                    id="alamat"
                                    name="alamat"
                                    rows="3"
                                    placeholder="Alamat sekolah"></textarea>

                            </div>

                        </div>

                    </div>


                    <div class="admin-form-section">

                        <h3>
                            Informasi Profil
                        </h3>

                        <div class="admin-form-grid">

                            <div class="admin-form-group full">

                                <label for="deskripsi">
                                    Deskripsi Sekolah
                                </label>

                                <textarea
                                    id="deskripsi"
                                    name="deskripsi"
                                    rows="4"
                                    placeholder="Deskripsi singkat sekolah"></textarea>

                            </div>


                            <div class="admin-form-group full">

                                <label for="sambutan">
                                    Sambutan Kepala Sekolah
                                </label>

                                <textarea
                                    id="sambutan"
                                    name="sambutan"
                                    rows="5"
                                    placeholder="Tuliskan sambutan kepala sekolah"></textarea>

                            </div>


                            <div class="admin-form-group full">

                                <label for="sejarah">
                                    Sejarah Sekolah
                                </label>

                                <textarea
                                    id="sejarah"
                                    name="sejarah"
                                    rows="5"
                                    placeholder="Tuliskan sejarah sekolah"></textarea>

                            </div>


                            <div class="admin-form-group full">

                                <label for="visi">
                                    Visi
                                </label>

                                <textarea
                                    id="visi"
                                    name="visi"
                                    rows="4"
                                    placeholder="Tuliskan visi sekolah"></textarea>

                            </div>


                            <div class="admin-form-group full">

                                <label for="misi">
                                    Misi
                                </label>

                                <textarea
                                    id="misi"
                                    name="misi"
                                    rows="5"
                                    placeholder="Tuliskan misi sekolah"></textarea>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="admin-modal-footer">

                    <button
                        type="button"
                        class="admin-btn admin-btn-secondary"
                        id="btnCancelProfil">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="admin-btn admin-btn-primary"
                        id="btnSaveProfil">

                        <span id="btnSaveProfilText">
                            Simpan Profil
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('profilModal');

    const form = document.getElementById('profilForm');

    const modalTitle = document.getElementById('profilModalTitle');

    const profilId = document.getElementById('profilId');

    const csrfToken =
        document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    const fields = [
        'nama_sekolah',
        'npsn',
        'alamat',
        'telepon',
        'email',
        'kepala_sekolah',
        'sambutan',
        'deskripsi',
        'sejarah',
        'visi',
        'misi'
    ];


    function openModal() {

        modal.classList.add('show');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('modal-open');

    }


    function closeModal() {

        modal.classList.remove('show');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('modal-open');

    }


    function resetForm() {

        form.reset();

        profilId.value = '';

        modalTitle.textContent = 'Tambah Profil';

        document.getElementById('btnSaveProfilText').textContent =
            'Simpan Profil';

    }


    document.getElementById('btnTambahProfil')
        .addEventListener('click', () => {

            resetForm();

            openModal();

        });


    document.getElementById('btnCloseProfilModal')
        .addEventListener('click', closeModal);


    document.getElementById('btnCancelProfil')
        .addEventListener('click', closeModal);


    document.getElementById('profilModalOverlay')
        .addEventListener('click', closeModal);


    document.getElementById('adminSidebarToggle')
        ?.addEventListener('click', () => {

            document
                .getElementById('adminSidebar')
                .classList.toggle('show-mobile');

        });


    document.querySelectorAll('.btn-edit-profil')
        .forEach(button => {

            button.addEventListener('click', async () => {

                const id = button.dataset.id;

                try {

                    const response = await fetch(
                        `/admin/profil/${id}`,
                        {
                            headers: {
                                'Accept': 'application/json'
                            }
                        }
                    );

                    const result = await response.json();

                    if (!response.ok || !result.success) {
                        throw new Error(
                            result.message ||
                            'Data profil gagal diambil.'
                        );
                    }


                    const data = result.data;

                    profilId.value = data.id;

                    fields.forEach(field => {

                        const input =
                            document.getElementById(field);

                        if (input) {
                            input.value = data[field] ?? '';
                        }

                    });


                    modalTitle.textContent =
                        'Edit Profil Sekolah';

                    document.getElementById('btnSaveProfilText')
                        .textContent = 'Simpan Perubahan';

                    openModal();

                } catch (error) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.message
                    });

                }

            });

        });


    form.addEventListener('submit', async (event) => {

        event.preventDefault();


        const id = profilId.value;

        const isEdit = id !== '';

        const url = isEdit
            ? `/admin/profil/${id}`
            : `/admin/profil`;


        const formData = new FormData(form);

        if (isEdit) {
            formData.append('_method', 'PUT');
        }


        const saveButton =
            document.getElementById('btnSaveProfil');

        saveButton.disabled = true;

        document.getElementById('btnSaveProfilText')
            .textContent = 'Menyimpan...';


        try {

            const response = await fetch(url, {

                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },

                body: formData

            });


            const result = await response.json();


            if (!response.ok) {

                let message =
                    result.message ||
                    'Terjadi kesalahan.';

                if (result.errors) {

                    message = Object.values(result.errors)
                        .flat()
                        .join('<br>');

                }

                throw new Error(message);

            }


            closeModal();

            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: result.message,
                timer: 1800,
                showConfirmButton: false
            });

            window.location.reload();


        } catch (error) {

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: error.message
            });

        } finally {

            saveButton.disabled = false;

            document.getElementById('btnSaveProfilText')
                .textContent =
                    isEdit
                        ? 'Simpan Perubahan'
                        : 'Simpan Profil';

        }

    });


    document.querySelectorAll('.btn-delete-profil')
        .forEach(button => {

            button.addEventListener('click', async () => {

                const id = button.dataset.id;


                const confirmation = await Swal.fire({

                    icon: 'warning',

                    title: 'Hapus Profil?',

                    text: 'Data profil yang dihapus tidak dapat dikembalikan.',

                    showCancelButton: true,

                    confirmButtonText: 'Ya, Hapus',

                    cancelButtonText: 'Batal',

                    reverseButtons: true

                });


                if (!confirmation.isConfirmed) {
                    return;
                }


                try {

                    const response = await fetch(
                        `/admin/profil/${id}`,
                        {
                            method: 'DELETE',

                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        }
                    );


                    const result = await response.json();


                    if (!response.ok || !result.success) {

                        throw new Error(
                            result.message ||
                            'Data gagal dihapus.'
                        );

                    }


                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: result.message,
                        timer: 1500,
                        showConfirmButton: false
                    });


                    window.location.reload();


                } catch (error) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.message
                    });

                }

            });

        });

});

</script>

@endpush