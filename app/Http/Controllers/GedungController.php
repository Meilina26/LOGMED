<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $gedung = Gedung::withCount('users')->paginate(10);
        return view('gedung.index',compact('gedung'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gedung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required',
            'lokasi' => 'nullable',
            'penanggung_jawab' => 'nullable',
        ]);

         
        Gedung::create([
            'kode_gedung'    => $kodeGedung,
            'nama_gedung'    => $request->nama_gedung,
            'lokasi'         => $request->lokasi,
            'penanggung_jawab' => $request->penanggung_jawab,
        ]);

        return redirect()->route('gedung.index')
            ->with('success', 'Data gedung berhasil ditambahkan.');
    }

    private function generateKodeGedung()
    {
        $last = Gedung::latest('id')->first();

        if (!$last) {
            return 'GDG0001';
        }

        $number = intval(substr($last->kode_gedung, 3)) + 1;

        return 'GDG' . str_pad($number, 4, '0', STR_PAD_LEFT);
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
    public function edit(Gedung $gedung)
    {
        return view('gedung.edit', compact('gedung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gedung $gedung)
    {
        $request->validate([
            'nama_gedung'=>'required',
            'lokasi'=>'required',
            'penanggung_jawab'=>'required'
        ]);

        $gedung->update($request->only(
            'nama_gedung',
            'lokasi',
            'penanggung_jawab'
        ));

        return redirect()->route('gedung.index')
            ->with('success','Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gedung $gedung)
    {
        $gedung->delete();

        return redirect()->route('gedung.index')
            ->with('success','Data berhasil dihapus.');
    }
}
