@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Laporan Penggunaan Obat
        </h1>
        <p class="subjudul">
            Filter laporan penggunaan obat pada setiap gedung
        </p>
    </div>
</div>

<div class="form-card">

    <form method="GET" action="{{ route('laporan.admin.penggunaan') }}">

        <div class="form-grid">

            <div class="input-group">
                <label>Tanggal Awal</label>
                <input
                    type="date"
                    name="awal"
                    class="form-input"
                    value="{{ request('awal') }}">
            </div>

            <div class="input-group">
                <label>Tanggal Akhir</label>
                <input
                    type="date"
                    name="akhir"
                    class="form-input"
                    value="{{ request('akhir') }}">
            </div>

            <div class="input-group">
                <label>Gedung</label>

                <select name="gedung" class="form-input">
                    <option value="">Semua Gedung</option>

                    @foreach($gedung as $g)

                        <option
                            value="{{ $g->id }}"
                            {{ request('gedung') == $g->id ? 'selected' : '' }}>

                            {{ $g->nama_gedung }}

                        </option>

                    @endforeach

                </select>
            </div>

        </div>

        <div class="form-button">

            <button class="btn-save-tambah">
                Preview
            </button>

        </div>

    </form>

    @if(isset($error))
        <div class="alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ $error }}
        </div>
    @endif

</div>


@if($penggunaan->count())

<div class="recent-card">
    <table class="table-data">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Gedung</th>
                <th>Pengguna</th>
                <th>Obat</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>

        @foreach($penggunaan as $item)

            <tr>
                <td>
                    {{ $item->created_at->format('d-m-Y') }}
                </td>
                <td>
                    {{ $item->user->gedung->nama_gedung }}
                </td>
                <td>
                    {{ $item->user->name }}
                </td>
                <td>
                    {{ $item->obat->nama_obat }}
                </td>
                <td>
                    {{ $item->jumlah }}
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>

    <div style="margin-top:20px">
        <a
            href="{{ route('laporan.admin.penggunaan.pdf', request()->all()) }}"
            class="btn-save">

            <i class="fa-solid fa-file-pdf"></i>
            Download PDF
        </a>
    </div>
</div>

@endif

@endsection