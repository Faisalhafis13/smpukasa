<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\BeritaRepository;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function __construct(
        protected BeritaRepository $beritaRepository
    ) {
    }

    public function index(): View
    {
        $beritas = $this->beritaRepository->getPublished();

        return view('public.berita.index', compact('beritas'));
    }

    public function show(string $slug): View
    {
        $berita = $this->beritaRepository->findBySlug($slug);

        abort_if(!$berita, 404);

        return view('public.berita.show', compact('berita'));
    }
}