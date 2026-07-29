@extends('layouts.app')

@section('content')

<div class="form-card">

    <div class="form-header">
        <h1>Tambah Data Gedung</h1>
        <p>Silakan isi data gedung.</p>
    </div>

    <form action="{{ route('gedung.store') }}" method="POST">

        @csrf

        <div class="input-group">
            <label>Nama Gedung</label>
            <input type="text"
                name="nama_gedung"
                class="form-input"
                required>
        </div>

        <br>

        <div class="input-group">
            <label>Lokasi</label>
            <input type="text"
                name="lokasi"
                class="form-input"
                required>
        </div>

        <br>

        <div class="input-group">
            <label>Penanggung Jawab</label>
            <input type="text"
                name="penanggung_jawab"
                class="form-input"
                required>
        </div>

        
        <div class="form-button">

            <a href="{{ route('gedung.index') }}"
            class="btn-cancel">
                Batal
            </a>

            <button type="submit"
            class="btn-save">
                Simpan
            </button>

        </div>

    </form>

</div>

@endsection