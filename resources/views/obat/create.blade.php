@extends('layouts.app')

@section('content')

<div class="form-card">

    <div class="form-header">
        <h1>
            Tambah Data Obat
        </h1>
        <p>Tambahkan data obat baru ke dalam sistem LOGMED.</p>
    </div>

    <form action="{{ route('obat.store') }}" method="POST">

        @csrf

        <div class="form-grid">

            <div class="input-group">
                <label>Nama Obat</label>
                <input
                    type="text"
                    name="nama_obat"
                    class="form-input"
                    placeholder="Masukkan nama obat"
                    required>
            </div>

            <div class="input-group">
                <label>Jenis Obat</label>

                <select
                    name="jenis_obat"
                    class="form-input">

                    <option value="">-- Pilih Jenis Obat --</option>
                    <option>Tablet</option>
                    <option>Kapsul</option>
                    <option>Sirup</option>
                    <option>Injeksi</option>
                    <option>Salep</option>

                </select>

            </div>

            <div class="input-group">
                <label>Satuan</label>

                <input
                    type="text"
                    name="satuan"
                    class="form-input"
                    placeholder="Contoh : Strip">
            </div>

            <div class="input-group">
                <label>Stok</label>

                <input
                    type="number"
                    name="stok_pusat"
                    class="form-input"
                    placeholder="Masukkan stok">
            </div>

            <div class="input-group">
                <label>Tanggal Expired</label>

                <input
                    type="date"
                    name="expired_date"
                    class="form-input">
            </div>

        </div>

        <div class="form-button">
            <a href="{{ route('obat.index') }}" class="btn-cancel">
                Batal
            </a>
            <button type="submit" class="btn-save-tambah">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan
            </button>

        </div>
    </form>
</div>

@endsection