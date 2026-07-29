@extends('layouts.app-petugas')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">Gunakan Obat</h1>
        <p class="subjudul">Catat penggunaan obat gedung.</p>
    </div>
</div>

<form action="{{ route('stok.simpan', $stok->id) }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Nama Obat</label>
        <input type="text"
               class="form-control"
               value="{{ $stok->obat->nama_obat }}"
               readonly>
    </div>

    <br>

    <div class="form-group">
        <label>Stok Saat Ini</label>
        <input type="text"
               class="form-control"
               value="{{ $stok->jumlah_stok }} {{ $stok->obat->satuan }}"
               readonly>
    </div>

    <br>

    <div class="form-group">
        <label>Jumlah Dipakai</label>
        <input type="number"
               name="jumlah"
               class="form-control"
               min="1"
               required>
    </div>

    <br>

    <div class="form-group">
        <label>Keperluan</label>
        <textarea name="keterangan"
                  class="form-control"
                  rows="3"
                  placeholder="Contoh: Pasien demam, kegiatan posyandu..."
                  required></textarea>
    </div>

    <br>

    <button type="submit" class="btn-request">
        Simpan Penggunaan
    </button>
</form>

@endsection