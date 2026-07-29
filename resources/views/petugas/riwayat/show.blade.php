@extends('layouts.app-petugas')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Detail Permintaan
        </h1>

        <p class="subjudul">
            PRM{{ str_pad($permintaan->id,3,'0',STR_PAD_LEFT) }}
        </p>
    </div>
</div>

<div class="form-card">
    <p><strong>Gedung :</strong>
        {{ $permintaan->user->gedung->nama_gedung }}
    </p>

    <p><strong>Status :</strong>
        {{ ucfirst($permintaan->status) }}
    </p>

    <p><strong>Catatan :</strong>
        {{ $permintaan->catatan ?: '-' }}
    </p>

    <hr>

    <h3>Daftar Obat</h3>

    <table class="table-data">
        <thead>
            <tr>
                <th>Obat</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>

        @foreach($permintaan->detail as $detail)

            <tr>
                <td>{{ $detail->obat->nama_obat }}</td>
                <td>{{ $detail->jumlah }}</td>
                <td>{{ $detail->obat->satuan }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>

@endsection