@extends('layouts.app')

@section('content')

<div class="form-card">
    <div class="form-header">
        <h1>
            <i class="fa-solid fa-pen-to-square"></i>
            Edit Data User
        </h1>
        <p>Perbarui informasi user yang tersedia di LOGMED.</p>
    </div>

    <form action="{{ route('user.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input-group">
            <label>Nama User</label>
            <input
                type="text"
                name="name"
                class="form-input"
                value="{{ old('name', $user->name) }}"
                required>
        </div>

        <br>

        <div class="input-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-input"
                value="{{ old('email', $user->email) }}"
                required>
        </div>

        <br>

        <div class="input-group">
            <label>Password</label>
            <input
                type="password"
                name="password"
                class="form-input"
                placeholder="Kosongkan jika tidak ingin mengubah password">
        </div>

        <br>

        <div class="input-group">
            <label>Role</label>
            <select name="role" class="form-input" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user_gedung" {{ old('role', $user->role) == 'user_gedung' ? 'selected' : '' }}>User Gedung</option>
            </select>
        </div>

        <br>

        <div class="input-group">
            <label>Gedung</label>
            <select name="id_gedung" class="form-input">
                <option value="">Pilih Gedung</option>
                @foreach($gedung as $g)
                    <option value="{{ $g->id }}" {{ old('id_gedung', $user->id_gedung) == $g->id ? 'selected' : '' }}>{{ $g->nama_gedung }}</option>
                @endforeach
            </select>
        </div>

        <br>

        <div class="form-button">
            <a href="{{ route('user.index') }}" class="btn-cancel">
                Batal
            </a>

            <button class="btn-save">
                Simpan Perubahan
            </button>
        </div>
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
                