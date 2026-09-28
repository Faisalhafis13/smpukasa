<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\ProgramRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function __construct(
        protected ProgramRepository $programRepository
    ) {
    }

    public function index(Request $request): View
    {
        $jenis = $request->query('jenis');

        if (
            $jenis !== 'Program Unggulan' &&
            $jenis !== 'Ekstrakurikuler'
        ) {
            $jenis = null;
        }

        $programs = $jenis
            ? $this->programRepository->getByJenis($jenis)
            : $this->programRepository->getAll();

        return view('public.program.index', compact(
            'programs',
            'jenis'
        ));
    }
}