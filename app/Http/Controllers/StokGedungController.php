<?php

namespace App\Http\Controllers;

use App\Models\StokGedung;
use App\Models\PenggunaanObat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StokGedungController extends Controller
{
    public function index()
    {
        $stok = StokGedung::with('obat')
            ->where('id_gedung', auth()->user()->id_gedung)
            ->paginate(10);

        return view('petugas.stok.index', compact('stok'));
    }

    public function gunakan($id)
    {
        $stok = StokGedung::with('obat')->findOrFail($id);

        return view('petugas.stok.gunakan', compact('stok'));
    }

    public function simpanPenggunaan(Request $request, $id)
    {
        $request->validate([
            'jumlah'=>'required|integer|min:1',
            'keterangan'=>'required'
        ]);

        $stok = StokGedung::findOrFail($id);

        if($request->jumlah > $stok->jumlah_stok){

            return back()->with(
                'error',
                'Jumlah melebihi stok.'
            );

        }

        $stok->jumlah_stok -= $request->jumlah;

        $stok->save();

        PenggunaanObat::create([
            'id_stok'=>$stok->id,
            'jumlah'=>$request->jumlah,
            'keterangan'=>$request->keterangan
        ]);

        return redirect()
                ->route('stok.index')
                ->with(
                    'success',
                    'Penggunaan obat berhasil dicatat.'
                );
    }

    public function downloadForm()
    {
        $pdf = Pdf::loadView('petugas.stok.form_penggunaan');

        return $pdf->stream('Form_Penggunaan_Obat.pdf');
    }
}