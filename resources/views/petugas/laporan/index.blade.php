@extends('layouts.app-petugas')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Laporan
        </h1>

        <p class="subjudul">
            Rekap pengajuan dan penerimaan obat gedung Anda.
        </p>
    </div>
</div>

<div class="card-dashboard">

    <div class="card-item">
        <i class="fa-solid fa-file-circle-check"></i>
        <h2>{{ $totalPengajuan }}</h2>
        <p>Total Pengajuan</p>
    </div>

    <div class="card-item">
        <i class="fa-solid fa-circle-check"></i>
        <h2>{{ $disetujui }}</h2>
        <p>Disetujui</p>
    </div>

    <div class="card-item">
        <i class="fa-solid fa-circle-xmark"></i>
        <h2>{{ $ditolak }}</h2>
        <p>Ditolak</p>
    </div>

    <div class="card-item">
        <i class="fa-solid fa-box-open"></i>
        <h2>{{ $selesai }}</h2>
        <p>Selesai</p>
    </div>

</div>

<div class="recent-card">
    <table class="table-data">

        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($permintaan as $item)

            <tr>
                <td>
                    PRM{{ str_pad($item->id,3,'0',STR_PAD_LEFT) }}
                </td>
                <td>
                    {{ $item->created_at->format('d M Y') }}
                </td>
                <td>
                    <span class="badge-status
                    @if($item->status=='menunggu') warning
                    @elseif($item->status=='disetujui') info
                    @elseif($item->status=='selesai') success
                    @else danger
                    @endif">
                        {{ ucfirst($item->status) }}

                    </span>
                </td>
                <td class="aksi-petugas">
                    <a href="{{ route('riwayat.show',$item->id) }}" class="btn-eye">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                    <a href="{{ route('laporan.pdf',$item->id) }}" class="btn-pdf" target="_blank">
                        <i class="fa-solid fa-file-pdf"></i>
                    </a>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="3" align="center">
                    Belum ada data laporan.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>
</div>

@endsection