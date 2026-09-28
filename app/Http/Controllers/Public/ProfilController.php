<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\ProfilRepository;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function __construct(
        protected ProfilRepository $profilRepository
    ) {
    }

    public function index(): View
    {
        $profil = $this->profilRepository->getProfil();

        return view('public.profil.index', compact('profil'));
    }
}