@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Distribusi Obat
        </h1>

        <p class="subjudul">
            Kelola seluruh proses distribusi obat.
        </p>
    </div>
</div>

<table class="table-data">

    <thead>
        <tr>
            <th>Kode</th>
            <th>Gedung</th>
            <th>Pemohon</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th width="120">Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($permintaan as $item)

        <tr>
            <td>
                PRM{{ str_pad($item->id,3,'0',STR_PAD_LEFT) }}
            </td>
            <td>
                {{ $item->user->gedung->nama_gedung ?? '-' }}
            </td>
            <td>
                {{ $item->user->name }}
            </td>
            <td>
                <span class="badge-status
                    @if($item->status=='menunggu')
                        warning
                    @elseif($item->status=='disetujui')
                        info
                    @elseif($item->status=='selesai')
                        success
                    @else
                        danger
                    @endif">

                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>
                {{ $item->created_at->format('d M Y') }}
            </td>
            <td>
                <a href="{{ route('distribusi.show',$item->id) }}"
                   class="btn-detail">

                    <i class="fa-solid fa-eye"></i>
                </a>
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="6">
                Belum ada permintaan.
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

<div class="pagination-wrapper">
    {{ $permintaan->links() }}
</div>

<div class="pagination-wrapper">
    {{ $permintaan->links() }}
</div>

@endsection