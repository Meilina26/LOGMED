@extends('layouts.app')

@section('content')

<div class="form-card">
    <div class="form-header">
        <h1>
            <i class="fa-solid fa-pen-to-square"></i>
            Edit Data Obat
        </h1>
        <p>Perbarui informasi obat yang tersedia di LOGMED.</p>
    </div>

    <form action="{{ route('obat.update',$obat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input-group">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-input" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
        </div>

        <br>

        <div class="input-group">
            <label>Jenis Obat</label>
            <input type="text" name="jenis_obat" class="form-input" value="{{ old('jenis_obat', $obat->jenis_obat) }}" required>
        </div>

        <br>

        <div class="input-group">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-input" value="{{ old('satuan', $obat->satuan) }}" required>
        </div>

        <br>

        <div class="input-group">
            <label>Stok</label>
            <input type="number" name="stok_pusat" class="form-input" value="{{ old('stok_pusat', $obat->stok_pusat) }}" required>
        </div>

        <br>
        
        <div class="input-group">
            <label>Expired Date</label>
            <input type="date" name="expired_date" class="form-input" value="{{ old('expired_date', $obat->expired_date) }}" required>
        </div>

        <br>
        <div class="form-button">
            <a href="{{ route('obat.index') }}" class="btn-cancel">
                Batal
            </a>

            <button class="btn-save">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>

@endsection