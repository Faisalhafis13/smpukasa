<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\GuruRepository;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function __construct(
        protected GuruRepository $guruRepository
    ) {
    }

    public function index(): View
    {
        $gurus = $this->guruRepository->getAll();

        return view(
            'public.guru.index',
            compact('gurus')
        );
    }
}