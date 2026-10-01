<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSpmb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftarSpmbController extends Controller
{
    private const STATUSES = [
        'Menunggu Verifikasi',
        'Diverifikasi',
        'Diterima',
        'Ditolak',
    ];

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = min(max((int) $request->query('per_page', 10), 10), 100);
        $status = (string) $request->query('filter_status', '');

        if (! in_array($status, self::STATUSES, true)) {
            $status = '';
        }

        $pendaftarans = PendaftaranSpmb::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('nisn', 'like', "%{$search}%")
                        ->orWhere('asal_sekolah', 'like', "%{$search}%")
                        ->orWhere('nama_orang_tua', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                });
            })
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.pendaftar.index', [
            'pendaftarans' => $pendaftarans,
            'search' => $search,
            'status' => $status,
            'statuses' => self::STATUSES,
        ]);
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
        ]);

        PendaftaranSpmb::query()->findOrFail($id)->update($validated);

        return redirect()
            ->route('admin.pendaftar.index', $request->only('search', 'filter_status'))
            ->with('success', 'Status pendaftar berhasil diperbarui.');
    }
}