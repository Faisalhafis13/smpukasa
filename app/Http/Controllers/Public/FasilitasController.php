<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\FasilitasRepository;
use Illuminate\View\View;

class FasilitasController extends Controller
{
    public function __construct(
        protected FasilitasRepository $fasilitasRepository
    ) {
    }

    public function index(): View
    {
        $fasilitas = $this->fasilitasRepository->getAll();

        return view(
            'public.fasilitas.index',
            compact('fasilitas')
        );
    }
}