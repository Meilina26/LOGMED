@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Detail Distribusi
        </h1>

        <p class="subjudul">
            Informasi lengkap permintaan obat.
        </p>
    </div>
</div>

<div class="permintaan-card">
    <div class="card-header">
        <div>
            <h3>
                PRM{{ str_pad($permintaan->id,3,'0',STR_PAD_LEFT) }}
            </h3>

            <small>
                {{ $permintaan->created_at->format('d M Y') }}
            </small>
        </div>

        <span class="badge-status
            @if($permintaan->status=='menunggu')
                warning
            @elseif($permintaan->status=='disetujui')
                info
            @elseif($permintaan->status=='selesai')
                success
            @else
                danger
            @endif">
            {{ ucfirst($permintaan->status) }}
        </span>
    </div>

    <hr>

    <p>
        <strong>Gedung :</strong>
        {{ $permintaan->user->gedung->nama_gedung ?? '-' }}
    </p>

    <p>
        <strong>Pemohon :</strong>
        {{ $permintaan->user->name }}
    </p>

    <p>
        <strong>Catatan :</strong><br>
        {{ $permintaan->catatan ?: '-' }}
    </p>

    <h4>Daftar Obat</h4>
    <table class="table-data">
        <thead>
            <tr>
                <th>Nama Obat</th>
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

    <br>

    <div class="aksi-distribusi">

        @if($permintaan->status=='menunggu')

            <form action="{{ route('distribusi.setujui',$permintaan->id) }}" method="POST">
                @csrf
                <button class="btn-setuju">
                    <i class="fa-solid fa-check"></i>
                    Setujui
                </button>
            </form>

            <form action="{{ route('distribusi.tolak',$permintaan->id) }}" method="POST">
                @csrf
                <button class="btn-tolak">
                    <i class="fa-solid fa-xmark"></i>
                    Tolak
                </button>
            </form>

        @elseif($permintaan->status=='disetujui')

            <form action="{{ route('distribusi.kirim',$permintaan->id) }}" method="POST">
                @csrf
                <button class="btn-kirim">
                    <i class="fa-solid fa-truck-fast"></i>
                    Kirim Obat
                </button>
            </form>

        @elseif($permintaan->status=='selesai')

            <span style="color:#16A34A;font-weight:600;">
                <i class="fa-solid fa-circle-check"></i>
                Distribusi selesai
            </span>

        @else

            <span style="color:#DC2626;font-weight:600;">
                <i class="fa-solid fa-circle-xmark"></i>
                Permintaan ditolak
            </span>

        @endif

    </div>

</div>

@endsection