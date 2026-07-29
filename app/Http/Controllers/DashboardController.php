<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\User;
use App\Models\Gedung;
use App\Models\Permintaan;
use App\Models\StokGedung;
use App\Models\PenggunaanObat;

class DashboardController extends Controller
{
    public function index()
    {
        $totalObat = Obat::count();
        $totalGedung = Gedung::count();
        $totalUser = User::where('role', 'user_gedung')->count();

        $bulan = [];
        $jumlahDistribusi = [];

        $jumlahPenggunaan = [];

        for ($i = 5; $i >= 0; $i--) {
            $tanggal = now()->subMonths($i);
            $bulan[] = $tanggal->translatedFormat('M');

            $jumlahDistribusi[] = Permintaan::where('status','selesai')
                ->whereMonth('created_at',$tanggal->month)
                ->whereYear('created_at',$tanggal->year)
                ->count();

            $jumlahPenggunaan[] = PenggunaanObat::whereMonth('created_at',$tanggal->month)
                ->whereYear('created_at',$tanggal->year)
                ->count();
        }

        $status = [
            'menunggu' => Permintaan::where('status', 'menunggu')->count(),
            'disetujui' => Permintaan::where('status', 'disetujui')->count(),
            'selesai' => Permintaan::where('status', 'selesai')->count(),
            'ditolak' => Permintaan::where('status', 'ditolak')->count(),
        ];

        $notifikasi = Permintaan::with('user.gedung')
            ->where('status', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        $stokMenipis = StokGedung::with([
                'obat',
                'gedung'
            ])
            ->where('jumlah_stok', '<=', 20)
            ->orderBy('jumlah_stok')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalObat',
            'totalGedung',
            'totalUser',
            'bulan',
            'jumlahDistribusi',
            'status',
            'notifikasi',
            'stokMenipis',
            'jumlahPenggunaan'
        ));
    }
}