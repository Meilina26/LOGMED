@extends('layouts.app-petugas')

@section('content')

<div class="page-header">

    <div>
        <h1 class="judul-halaman">
            Permintaan Obat
        </h1>

        <p class="subjudul">
            Kelola permintaan obat gedung Anda.
        </p>
    </div>
</div>

<div class="toolbar">
    <a href="{{ route('permintaan.create') }}" class="btn-tambah">
        <i class="fa-solid fa-plus"></i>
        Buat Permintaan
    </a>
</div>

<table class="table-data">

    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($permintaan as $item)

        <tr>
            <td>PRM{{ str_pad($item->id,3,'0',STR_PAD_LEFT) }}</td>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ ucfirst($item->status) }}</td>
            <td>
                <a href="#" class="btn-edit">
                    <i class="fa-solid fa-eye"></i>
                </a>
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="4">
                Belum ada permintaan.
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

<div class="pagination-wrapper">
    {{ $permintaan->links() }}
</div>

@endsection