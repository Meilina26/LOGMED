@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Stok {{ $gedung->nama_gedung }}
        </h1>

        <p class="subjudul">
            Detail stok obat pada {{ $gedung->nama_gedung }}.
        </p>
    </div>
</div>

<div class="recent-card">
    <table class="table-data">
        <thead>
            <tr>
                <th>Nama Obat</th>
                <th>Jumlah Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>

        <tbody>

            @forelse($gedung->stokGedung as $stok)
                <tr>
                    <td>
                        {{ $stok->obat->nama_obat }}
                    </td>

                    <td>
                        {{ $stok->jumlah_stok }}
                    </td>

                    <td>
                        {{ $stok->obat->satuan }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="3" style="text-align:center;">
                        Belum ada stok obat.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

        <div style="margin-top:40px;">

        <h2 class="judul-halaman" style="font-size:24px;">
            Riwayat Penggunaan Obat
        </h2>

        <table class="table-data">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>

                @forelse($gedung->penggunaanObat as $pakai)

                    <tr>
                        <td>
                            {{ $pakai->created_at->format('d M Y') }}
                        </td>
                        <td>
                            {{ $pakai->stokGedung->obat->nama_obat }}
                        </td>
                        <td>
                            {{ $pakai->jumlah }}
                            {{ $pakai->stokGedung->obat->satuan }}
                        </td>
                        <td>
                            {{ $pakai->keterangan }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4">
                            Belum ada riwayat penggunaan.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        <a href="{{ route('monitoring.index') }}" class="btn-kembali-monitor">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>
</div>
</div>

@endsection