<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\PenggunaanObat;
use App\Models\Gedung;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanAdminController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function distribusi(Request $request)
    {
        $gedung = Gedung::orderBy('nama_gedung')->get();
        $permintaan = collect();

        if (!$request->filled('awal') && $request->filled('akhir')) {

            return view('admin.laporan.distribusi', [
                'permintaan' => collect(),
                'gedung' => $gedung,
                'error' => 'Silakan isi tanggal awal terlebih dahulu.'
            ]);
        }

        if (
            $request->filled('awal') &&
            $request->filled('akhir') &&
            $request->awal > $request->akhir
        ) {
            return view('admin.laporan.distribusi', [
                'permintaan' => collect(),
                'gedung' => $gedung,
                'error' => 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal.'
            ]);
        }

        $query = Permintaan::with([
            'user.gedung',
            'detail.obat'
        ]);

        if ($request->filled('awal')) {

            if ($request->filled('akhir')) {
                $query->whereBetween('created_at', [
                    $request->awal . ' 00:00:00',
                    $request->akhir . ' 23:59:59'
                ]);

            } else {
                $query->where(
                    'created_at',
                    '>=',
                    $request->awal . ' 00:00:00'
                );
            }

            if (
                $request->filled('gedung') &&
                $request->gedung != 'semua'
            ) {

                $query->whereHas('user', function ($q) use ($request) {

                    $q->where(
                        'id_gedung',
                        $request->gedung
                    );

                });

            }

            if (
                $request->filled('status') &&
                $request->status != 'semua'
            ) {

                $query->where(
                    'status',
                    $request->status
                );

            }

            $permintaan = $query
                ->latest()
                ->get();
        }

        return view(
            'admin.laporan.distribusi',
            compact(
                'permintaan',
                'gedung'
            )
        );
    }

    public function pdfDistribusi(Request $request)
    {
        $query = Permintaan::with([
            'user.gedung',
            'detail.obat'
        ]);

        // Filter tanggal
        if ($request->filled('awal')) {

            if ($request->filled('akhir')) {

                $query->whereBetween('created_at', [
                    $request->awal . ' 00:00:00',
                    $request->akhir . ' 23:59:59'
                ]);

            } else {

                $query->where(
                    'created_at',
                    '>=',
                    $request->awal . ' 00:00:00'
                );

            }

        }

        if (
            $request->filled('gedung') &&
            $request->gedung != 'semua'
        ) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where(
                    'id_gedung',
                    $request->gedung
                );
            });
        }

        if (
            $request->filled('status') &&
            $request->status != 'semua'
        ) {

            $query->where(
                'status',
                $request->status
            );

        }

        $permintaan = $query
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'admin.laporan.pdf_distribusi',
            compact('permintaan')
        );

        return $pdf->download('laporan-distribusi.pdf');
    }

    public function penggunaan(Request $request)
    {
        $gedung = Gedung::orderBy('nama_gedung')->get();
        $penggunaan = collect();

        if ($request->filled('awal')) {

            $query = PenggunaanObat::with([
                'obat',
                'user.gedung'
            ]);

            if ($request->filled('akhir')) {

                $query->whereBetween('created_at', [
                    $request->awal.' 00:00:00',
                    $request->akhir.' 23:59:59'
                ]);

            } else {
                $query->whereDate('created_at','>=',$request->awal);
            }

            if ($request->filled('gedung')) {

                $query->whereHas('user_gedung', function($q) use($request){
                    $q->where('id_gedung',$request->gedung);
                });
            }

            $penggunaan = $query
                ->latest()
                ->get();
        }

        return view(
            'admin.laporan.penggunaan',
            compact('penggunaan','gedung')
        );
    }

    public function penggunaanPdf()
    {

    }

    public function stokPdf()
    {

    }

    public function previewDistribusi(Request $request)
    {

    }
}