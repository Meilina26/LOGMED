<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;

class DashboardPetugasController extends Controller
{
    public function index()
    {
        $menunggu = Permintaan::where('user_id', auth()->id())
            ->where('status', 'menunggu')
            ->count();

        $diproses = Permintaan::where('user_id', auth()->id())
            ->where('status', 'disetujui')
            ->count();

        $diterima = Permintaan::where('user_id', auth()->id())
            ->where('status', 'selesai')
            ->count();

        return view('petugas.dashboard', compact(
            'menunggu',
            'diproses',
            'diterima'
        ));
    }
}