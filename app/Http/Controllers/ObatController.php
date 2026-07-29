<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $obat = Obat::when($search, function ($query) use ($search) {

            $query->where('kode_obat', 'like', "%{$search}%")
                ->orWhere('nama_obat', 'like', "%{$search}%")
                ->orWhere('jenis_obat', 'like', "%{$search}%")
                ->orWhere('satuan', 'like', "%{$search}%");

        })
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('obat.index', compact('obat'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'jenis_obat' => 'required',
            'satuan' => 'required',
            'stok_pusat' => 'required|integer',
            'expired_date' => 'required|date',
        ]);

         // Ambil data terakhir
        $lastObat = Obat::orderBy('id', 'desc')->first();

        if ($lastObat) {
            $lastNumber = (int) substr($lastObat->kode_obat, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeObat = 'OBT' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Obat::create([
            'kode_obat'    => $kodeObat,
            'nama_obat'    => $request->nama_obat,
            'jenis_obat'   => $request->jenis_obat,
            'satuan'       => $request->satuan,
            'stok_pusat'   => $request->stok_pusat,
            'expired_date' => $request->expired_date,
        ]);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
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
        $obat = Obat::findOrFail($id);
        return view('obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'jenis_obat' => 'required',
            'satuan' => 'required',
            'stok_pusat' => 'required|integer',
            'expired_date' => 'required|date',
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'jenis_obat' => $request->jenis_obat,
            'satuan' => $request->satuan,
            'stok_pusat' => $request->stok_pusat,
            'expired_date' => $request->expired_date,
        ]);

        return redirect()->route('obat.index')
        ->with('success', 'Data obat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}
