@extends('layouts.app')

@section('content')

<div class="form-card">
    <div class="form-header">
        <h1>
            <i class="fa-solid fa-pen-to-square"></i>
            Edit Data Gedung
        </h1>
        <p>Perbarui informasi data gedung yang terdaftar di LOGMED.</p>
    </div>

    <form action="{{ route('gedung.update',$gedung->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input-group">
            <label>Nama Gedung</label>
            <input
                type="text"
                name="nama_gedung"
                class="form-input"
                value="{{ old('nama_gedung', $gedung->nama_gedung) }}"
                required>
        </div>

        <br>

        <div class="input-group">
            <label>Lokasi</label>
            <input
                type="text"
                name="lokasi"
                class="form-input"
                value="{{ old('lokasi', $gedung->lokasi) }}"
                required>
        </div>

        <br>

        <div class="input-group">
            <label>Penanggung Jawab</label>
            <input
                type="text"
                name="penanggung_jawab"
                class="form-input"
                value="{{ old('penanggung_jawab', $gedung->penanggung_jawab) }}"
                required>
        </div>

        <br>
        <div class="form-button">
            <a href="{{ route('gedung.index') }}" class="btn-cancel">
                Batal
            </a>

            <button class="btn-save">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>

@endsection