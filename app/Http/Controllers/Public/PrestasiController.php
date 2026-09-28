<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\PrestasiRepository;
use Illuminate\View\View;

class PrestasiController extends Controller
{
    public function __construct(
        protected PrestasiRepository $prestasiRepository
    ) {
    }

    public function index(): View
    {
        $prestasis = $this->prestasiRepository->getAll();

        return view('public.prestasi.index', compact('prestasis'));
    }
}