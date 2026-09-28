<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\AgendaRepository;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function __construct(
        protected AgendaRepository $agendaRepository
    ) {
    }

    public function index(): View
    {
        $agendas = $this->agendaRepository->getAll();

        return view('public.agenda.index', compact('agendas'));
    }
}