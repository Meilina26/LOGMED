<?php

namespace App\Http\Controllers;

use App\Models\Gedung;

class MonitoringStokController extends Controller
{
    public function index()
    {
        $gedung = Gedung::with('stokGedung')->get();

        return view('monitoring.index', compact('gedung'));
    }

    public function show(Gedung $monitoring_stok)
    {
        $gedung = $monitoring_stok;

        $gedung->load('stokGedung.obat');

        $penggunaan = \App\Models\PenggunaanObat::with('stokGedung.obat')
            ->whereHas('stokGedung', function ($q) use ($gedung) {
                $q->where('id_gedung', $gedung->id);
            })
            ->latest()
            ->get();

        return view('monitoring.show', compact(
            'gedung',
            'penggunaan'
        ));
    }
}