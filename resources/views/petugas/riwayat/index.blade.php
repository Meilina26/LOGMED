@extends('layouts.app-petugas')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Riwayat Permintaan
        </h1>

        <p class="subjudul">
            Riwayat seluruh permintaan obat yang pernah Anda buat.
        </p>

    </div>
</div>

<table class="table-data">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Distribusi</th>
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

            <td>
                @if($item->distribusi)
                    {{ ucfirst($item->distribusi->status) }}
                @else
                    -
                @endif
            </td>

            <td class="aksi-riwayat">
                <a href="{{ route('riwayat.show',$item->id) }}" class="btn-eye">
                    <i class="fa-solid fa-eye"></i>
                </a>
            </td>
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="5" align="center">
                Belum ada riwayat permintaan.
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

<div class="pagination-wrapper">

    {{ $permintaan->links() }}

</div>

@endsection