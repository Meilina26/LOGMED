@extends('layouts.app-petugas')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Stok Gedung
        </h1>

        <p class="subjudul">
            Daftar stok obat yang tersedia di gedung Anda.
        </p>

    </div>
</div>

<div class="toolbar">
    <a href="{{ route('stok.form') }}" class="btn-request">
        <i class="fa-solid fa-file-arrow-down"></i>
        Download Form Penggunaan
    </a>
</div>

<table class="table-data">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($stok as $item)
        <tr>
            <td>{{ $item->obat->kode_obat }}</td>
            <td>{{ $item->obat->nama_obat }}</td>
            <td>{{ $item->obat->jenis_obat }}</td>
            <td>{{ $item->obat->satuan }}</td>
            <td>
                <strong>
                    {{ $item->jumlah_stok }}
                </strong>
            </td>
            <td>
                <a href="{{ route('stok.gunakan',$item->id) }}" class="btn-request">
                Gunakan
                </a>
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="5" align="center">
                Belum ada stok obat.
            </td>
        </tr>

    @endforelse
    </tbody>
</table>

<div class="pagination-wrapper">
    {{ $stok->links() }}
</div>

@endsection