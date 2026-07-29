<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Distribusi;
use App\Models\StokGedung;
use App\Models\Permintaan;
use Illuminate\Support\Facades\DB;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permintaan = Permintaan::with([
            'user.gedung',
            'detail.obat',
            'distribusi'
        ])->latest()->paginate(10);

        return view('distribusi.index', compact('permintaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $permintaan = Permintaan::with([
        'user.gedung',
        'detail.obat',
        'distribusi'
        ])->findOrFail($id);

        return view('distribusi.show', compact('permintaan'));
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

    public function setujui(Permintaan $permintaan)
    {
        $permintaan->update([
            'status'=>'disetujui'
        ]);

        return back()->with('success','Permintaan disetujui.');
    }

    public function tolak(Permintaan $permintaan)
    {
        $permintaan->update([
            'status'=>'ditolak'
        ]);

        return back()->with('success','Permintaan ditolak.');
    }

    public function kirim(Permintaan $permintaan)
    {
        DB::beginTransaction();

        try {

            foreach ($permintaan->detail as $detail) {

                // Kurangi stok pusat
                $detail->obat->decrement('stok_pusat', $detail->jumlah);

                // Tambah stok gedung
                $stok = StokGedung::firstOrCreate(
                    [
                        'id_gedung' => $permintaan->user->id_gedung,
                        'id_obat' => $detail->id_obat,
                    ],
                    [
                        'jumlah_stok' => 0,
                    ]
                );

                $stok->increment('jumlah_stok', $detail->jumlah);
            }

            Distribusi::create([
                'id_permintaan' => $permintaan->id,
                'status' => 'dikirim',
                'tanggal_kirim' => now(),
                'keterangan' => 'Obat telah dikirim',
            ]);

            $permintaan->update([
                'status' => 'selesai'
            ]);

            DB::commit();

            return back()->with('success', 'Obat berhasil dikirim.');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
