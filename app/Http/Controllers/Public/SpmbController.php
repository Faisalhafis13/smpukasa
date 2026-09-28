<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\SpmbRepository;
use Illuminate\View\View;

class SpmbController extends Controller
{
    public function __construct(
        protected SpmbRepository $spmbRepository
    ) {
    }

    public function index(): View
    {
        $spmb = $this->spmbRepository->getLatest();

        return view(
            'public.spmb.index',
            compact('spmb')
        );
    }
}