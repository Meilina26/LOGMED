<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\Obat;
use App\Models\DetailPermintaan;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permintaan = Permintaan::where('user_id', auth()->id())
                        ->latest()
                        ->paginate(10);

        return view('petugas.permintaan.index', compact('permintaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $obat = Obat::orderBy('nama_obat')->get();

        return view('petugas.permintaan.create', compact('obat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'catatan' => 'nullable|string',
            'obat' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {

            $permintaan = Permintaan::create([
                'user_id' => auth()->id(),
                'status' => 'menunggu',
                'catatan' => $request->catatan,
            ]);

            foreach ($request->obat as $idObat => $jumlah) {

                if ($jumlah > 0) {
                    DetailPermintaan::create([
                        'id_permintaan' => $permintaan->id,
                        'id_obat' => $idObat,
                        'jumlah' => $jumlah,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('permintaan.index')
                ->with('success','Permintaan berhasil dikirim.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error',$e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function riwayat()
    {
        $permintaan = Permintaan::with('distribusi')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->paginate(10);

        return view('petugas.riwayat.index', compact('permintaan'));
    }

    public function showRiwayat(Permintaan $permintaan)
    {
        // Supaya user tidak bisa melihat permintaan milik orang lain
        if ($permintaan->user_id != auth()->id()) {
            abort(403);
        }

        $permintaan->load([
            'detail.obat',
            'distribusi',
            'user.gedung'
        ]);

        return view('petugas.riwayat.show', compact('permintaan'));
    }

    public function laporan()
    {
        $permintaan = Permintaan::with('detail.obat')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->paginate(10);

        $totalPengajuan = Permintaan::where('user_id', auth()->id())->count();

        $disetujui = Permintaan::where('user_id', auth()->id())
                        ->where('status','disetujui')
                        ->count();

        $ditolak = Permintaan::where('user_id', auth()->id())
                        ->where('status','ditolak')
                        ->count();

        $selesai = Permintaan::where('user_id', auth()->id())
                        ->where('status','selesai')
                        ->count();

        return view('petugas.laporan.index', compact(
            'permintaan',
            'totalPengajuan',
            'disetujui',
            'ditolak',
            'selesai'
        ));
    }

    public function pdf($id)
    {
        $permintaan = Permintaan::with([
            'detail.obat',
            'user.gedung'
        ])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

        $pdf = Pdf::loadView(
            'petugas.laporan.pdf',
            compact('permintaan')
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'Permintaan-'.$permintaan->id.'.pdf'
        );
    }
}
