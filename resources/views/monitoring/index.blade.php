@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Monitoring Stok Gedung
        </h1>

        <p class="subjudul">
            Pantau ketersediaan stok obat pada setiap gedung.
        </p>
    </div>
</div>

<div class="recent-card">
    <table class="table-data">
        <thead>
            <tr>
                <th>Gedung</th>
                <th>Total Stok</th>
                <th>Status</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse($gedung as $g)

                @php

                    $totalStok = $g->stokGedung->sum('jumlah_stok');

                @endphp

                <tr>
                    <td>
                        {{ $g->nama_gedung }}
                    </td>
                    <td>
                        {{ $totalStok }}
                    </td>
                    <td>

                        @if($totalStok < 30)

                            <span class="badge-status danger">
                                Menipis
                            </span>

                        @elseif($totalStok < 100)

                            <span class="badge-status warning">
                                Waspada
                            </span>

                        @else

                            <span class="badge-status success">
                                Aman
                            </span>

                        @endif
                    </td>

                    <td style="text-align:center;">
                        <a href="{{ route('monitoring.show', $g->id) }}"
                           class="btn-monitor">

                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" style="text-align:center;">
                        Belum ada data stok gedung.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection