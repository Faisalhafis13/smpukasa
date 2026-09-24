<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Repositories\Public\HomeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected HomeRepository $homeRepository
    ) {
    }

    public function index(): View
    {
        $data = $this->homeRepository->getHomeData();

        return view('public.home.index', compact('data'));
    }

    public function apiIndex(): JsonResponse
    {
        $data = $this->homeRepository->getHomeData();

        return response()->json([
            'success' => true,
            'message' => 'Data beranda berhasil diambil.',
            'data' => $data,
        ]);
    }
}