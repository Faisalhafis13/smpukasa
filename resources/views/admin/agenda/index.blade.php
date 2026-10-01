@extends('admin.layouts.app')

@section('title', 'Agenda - Admin')
@section('page-title', 'Agenda')

@section('content')

<div class="admin-page-header">

    <div>
        <span class="admin-eyebrow">
            INFORMASI SEKOLAH
        </span>

        <h1>Agenda</h1>

        <p>
            Kelola agenda dan kegiatan SMP Unggulan Karangsawo.
        </p>
    </div>

    <button
        type="button"
        class="admin-btn admin-btn-primary"
        onclick="openAgendaModal()"
    >
        + Tambah Agenda
    </button>

</div>


<div class="admin-panel">

    <div class="admin-panel-header">

        <div>
            <h2>Daftar Agenda</h2>

            <p>
                Semua agenda kegiatan sekolah.
            </p>
        </div>

    </div>

    @include('admin.layouts.page-size', ['paginator' => $agendas])
    <form method="GET" action="{{ route('admin.agenda.index') }}" class="admin-search-bar">
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari judul, lokasi, penyelenggara, atau status..."
            aria-label="Cari agenda"
        >
        <button type="submit" class="admin-btn admin-btn-primary">Cari</button>
        @if ($search)
            <a href="{{ route('admin.agenda.index') }}" class="admin-btn admin-btn-secondary">Reset</a>
        @endif
    </form>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($agendas as $index => $agenda)

                    <tr>

                        <td>
                            {{ $agendas->firstItem() + $index }}
                        </td>

                        <td>

                            <strong>
                                {{ $agenda->judul }}
                            </strong>

                            @if ($agenda->deskripsi)

                                <small style="
                                    display:block;
                                    margin-top:5px;
                                    color:#64748b;
                                ">
                                    {{ Str::limit($agenda->deskripsi, 70) }}
                                </small>

                            @endif

                        </td>

                        <td>
                            {{ $agenda->tanggal->format('d M Y') }}
                        </td>

                        <td>
                            {{ $agenda->waktu
                                ? $agenda->waktu
                                : '-' }}
                        </td>

                        <td>
                            {{ $agenda->lokasi ?: '-' }}
                        </td>

                        <td>

                            @if ($agenda->status === 'aktif')

                                <span class="admin-badge admin-badge-success">
                                    Aktif
                                </span>

                            @else

                                <span class="admin-badge admin-badge-warning">
                                    Selesai
                                </span>

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
                                    onclick="editAgenda({{ $agenda->id }})"
                                >
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="admin-btn admin-btn-danger admin-btn-sm"
                                    onclick="deleteAgenda({{ $agenda->id }})"
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

                            <strong>{{ $search ? 'Tidak ada agenda yang cocok' : 'Belum ada agenda' }}</strong>

                            <p style="
                                color:#64748b;
                                margin-top:5px;
                            ">
                                {{ $search ? 'Coba kata kunci lain.' : 'Tambahkan agenda kegiatan sekolah.' }}
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @include('admin.layouts.pagination', ['paginator' => $agendas])

</div>


{{-- MODAL --}}

<div
    class="admin-modal"
    id="agendaModal"
    style="display:none;"
>

    <div
        class="admin-modal-overlay"
        onclick="closeAgendaModal()"
    ></div>


    <div class="admin-modal-content">

        <div class="admin-modal-header">

            <div>

                <h2 id="agendaModalTitle">
                    Tambah Agenda
                </h2>

                <p>
                    Lengkapi informasi kegiatan sekolah.
                </p>

            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="closeAgendaModal()"
            >
                ×
            </button>

        </div>


        <form id="agendaForm">

            <input
                type="hidden"
                id="agendaId"
            >


            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-full">

                    <label for="agendaJudul">
                        Judul Agenda
                    </label>

                    <input
                        type="text"
                        id="agendaJudul"
                        name="judul"
                        required
                        placeholder="Contoh: Upacara Bendera"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="agendaTanggal">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        id="agendaTanggal"
                        name="tanggal"
                        required
                    >

                </div>


                <div class="admin-form-group">

                    <label for="agendaWaktu">
                        Waktu
                    </label>

                    <input
                        type="time"
                        id="agendaWaktu"
                        name="waktu"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="agendaLokasi">
                        Lokasi
                    </label>

                    <input
                        type="text"
                        id="agendaLokasi"
                        name="lokasi"
                        placeholder="Contoh: Lapangan Sekolah"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="agendaPenyelenggara">
                        Penyelenggara
                    </label>

                    <input
                        type="text"
                        id="agendaPenyelenggara"
                        name="penyelenggara"
                        placeholder="Contoh: OSIS"
                    >

                </div>


                <div class="admin-form-group">

                    <label for="agendaStatus">
                        Status
                    </label>

                    <select
                        id="agendaStatus"
                        name="status"
                        required
                    >

                        <option value="aktif">
                            Aktif
                        </option>

                        <option value="selesai">
                            Selesai
                        </option>

                    </select>

                </div>


                <div class="admin-form-group admin-form-full">

                    <label for="agendaDeskripsi">
                        Deskripsi
                    </label>

                    <textarea
                        id="agendaDeskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Deskripsi kegiatan..."
                    ></textarea>

                </div>

            </div>


            <div class="admin-modal-footer">

                <button
                    type="button"
                    class="admin-btn admin-btn-secondary"
                    onclick="closeAgendaModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="admin-btn admin-btn-primary"
                >
                    Simpan Agenda
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const agendaModal =
    document.getElementById('agendaModal');

const agendaForm =
    document.getElementById('agendaForm');

const agendaId =
    document.getElementById('agendaId');


function openAgendaModal() {

    agendaForm.reset();

    agendaId.value = '';

    document.getElementById(
        'agendaModalTitle'
    ).textContent = 'Tambah Agenda';

    agendaModal.style.display = 'flex';

}


function closeAgendaModal() {

    agendaModal.style.display = 'none';

}


async function editAgenda(id) {

    const response =
        await fetch(`/admin/agenda/${id}`);

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

    agendaId.value = data.id;

    document.getElementById(
        'agendaJudul'
    ).value = data.judul ?? '';

    document.getElementById(
        'agendaTanggal'
    ).value = data.tanggal ?? '';

    document.getElementById(
        'agendaWaktu'
    ).value = data.waktu
        ? data.waktu.substring(0, 5)
        : '';

    document.getElementById(
        'agendaLokasi'
    ).value = data.lokasi ?? '';

    document.getElementById(
        'agendaPenyelenggara'
    ).value = data.penyelenggara ?? '';

    document.getElementById(
        'agendaStatus'
    ).value = data.status ?? 'aktif';

    document.getElementById(
        'agendaDeskripsi'
    ).value = data.deskripsi ?? '';


    document.getElementById(
        'agendaModalTitle'
    ).textContent = 'Edit Agenda';


    agendaModal.style.display = 'flex';

}


agendaForm.addEventListener(
    'submit',
    async function(event) {

        event.preventDefault();

        const id = agendaId.value;

        const formData =
            new FormData(this);

        let url = '/admin/agenda';

        if (id) {

            url = `/admin/agenda/${id}`;

            formData.append(
                '_method',
                'PUT'
            );

        }


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


        closeAgendaModal();

        setTimeout(() => {
            window.AdminAjax.refresh();
        }, 1500);

    }
);


async function deleteAgenda(id) {

    const confirmation =
        await Swal.fire({

            title: 'Hapus agenda?',

            text: 'Agenda yang dihapus tidak dapat dikembalikan.',

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
            `/admin/agenda/${id}`,
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