@extends('layouts.app')

@section('content')

<div class="form-card">
    <div class="form-header">
        <h1>Tambah Data User</h1>
        <p>Silakan isi data user.</p>
    </div>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="input-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
        </div>

        @error('name')
            <small style="color:red">{{ $message }}</small>
        @enderror

        <br>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
        </div>

        @error('email')
            <small style="color:red">{{ $message }}</small>
        @enderror

        <br>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" class="form-input" value="{{ old('password') }}" required>
        </div>

        @error('password')
            <small style="color:red">{{ $message }}</small>
        @enderror

        <br>

        <div class="input-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input" value="{{ old('password_confirmation') }}" required>
        </div>

        <br>

        <div class="input-group">
            <label>Role</label>
            <select name="role" id="role" class="form-input">
                <option value="">Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user_gedung" {{ old('role') == 'user_gedung' ? 'selected' : '' }}>User Gedung</option>
            </select>

        </div>

        <br>

        <div class="input-group" id="gedung-group">
            <label>Gedung</label>

            <select name="id_gedung" class="form-input">

                <option value="">Pilih Gedung</option>

                @foreach($gedung as $item)

                    <option value="{{ $item->id }}" {{ old('id_gedung') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_gedung }}
                    </option>

                @endforeach

            </select>
        </div>
        
        @error('id_gedung')
            <small style="color:red">{{ $message }}</small>
        @enderror

        <br>

        <div class="form-button">

            <a href="{{ route('user.index') }}" class="btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn-save">
                Simpan
            </button>

        </div>

    </form>

</div>

<script>

const role = document.getElementById('role');
const gedung = document.getElementById('gedung-group');

function toggleGedung(){

    if(role.value === 'admin'){
        gedung.style.display = 'none';
    }else{
        gedung.style.display = 'block';
    }

}

role.addEventListener('change', toggleGedung);

toggleGedung();

</script>

@endsection