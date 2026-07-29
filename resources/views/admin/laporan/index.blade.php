@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div>
            <h1 class="judul-halaman">
                Laporan
            </h1>

            <p class="subjudul">
                Cetak seluruh laporan yang tersedia pada sistem LOGMED.
            </p>

        </div>
    </div>

    <div class="laporan-grid">
        <div class="laporan-card">
            <div class="laporan-icon distribusi">
                <i class="fa-solid fa-truck-medical"></i>
            </div>

            <h3>
                Laporan Distribusi
            </h3>

            <p>
                Menampilkan seluruh data distribusi obat ke setiap gedung.
            </p>

            <a href="{{ route('laporan.admin.distribusi') }}"
               class="btn-laporan">

                <i class="fa-solid fa-eye"></i>

                Lihat Semua

            </a>

        </div>

        <div class="laporan-card">

            <div class="laporan-icon penggunaan">
                <i class="fa-solid fa-pills"></i>
            </div>

            <h3>
                Laporan Penggunaan
            </h3>

            <p>
                Menampilkan seluruh penggunaan obat dari setiap gedung.
            </p>

            <a href="{{ route('laporan.admin.penggunaan') }}"
               class="btn-laporan">

                <i class="fa-solid fa-eye"></i>

                Lihat Semua

            </a>

        </div>

        <div class="laporan-card">

            <div class="laporan-icon stok">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>

            <h3>
                Rekap Stok Gedung
            </h3>

            <p>
                Menampilkan stok obat yang masih tersedia di setiap gedung.
            </p>

            <a href="{{ route('laporan.admin.stok') }}"
               class="btn-laporan">
                <i class="fa-solid fa-eye"></i>
                Lihat Semua
            </a>

        </div>
    </div>

@endsection