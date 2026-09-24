<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\GaleriRepository;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function __construct(
        protected GaleriRepository $galeriRepository
    ) {
    }

    public function index(): View
    {
        $galeris = $this->galeriRepository->getAll();

        return view('public.galeri.index', compact('galeris'));
    }
}