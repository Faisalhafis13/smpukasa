<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSpmb;
use App\Models\Spmb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranSpmbController extends Controller
{
    public function create(): View
    {
        $spmb = $this->openPeriod();

        return view('public.spmb.pendaftaran', compact('spmb'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $this->openPeriod()) {
            return redirect()
                ->route('spmb.index')
                ->withErrors(['pendaftaran' => 'Pendaftaran saat ini belum dibuka.']);
        }

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nisn' => ['nullable', 'digits:10'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:2000'],
            'nama_orang_tua' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30', 'regex:/^[0-9+().\-\s]{8,30}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'persetujuan' => ['accepted'],
        ]);

        unset($validated['persetujuan']);
        $validated['status'] = 'Menunggu Verifikasi';

        PendaftaranSpmb::create($validated);

        return redirect()
            ->route('spmb.pendaftaran.create')
            ->with('success', 'Pendaftaran berhasil dikirim. Pihak sekolah akan menghubungi wali calon murid.');
    }

    private function openPeriod(): ?Spmb
    {
        $period = Spmb::query()->latest('id')->first();

        return $period?->status === 'Dibuka' ? $period : null;
    }
}