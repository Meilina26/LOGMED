<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | LOGMED</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="register-container">

        <div class="logo">
            <span class="log">LOG</span><span class="med">MED</span>
        </div>

        <div class="register-card">

            <h1>SIGN UP</h1>
            <p>Buat akun Anda terlebih dahulu.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-box">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>
                </div>

                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                </div>

                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="input-box">
                    <i class="fa-solid fa-building"></i>

                    <select name="id_gedung" required>
                        <option value="">Pilih Gedung</option>

                        @foreach($gedung as $item)
                            <option value="{{ $item->id }}" {{ old('id_gedung') == $item->id ? 'selected' : '' }}> 
                                {{ $item->nama_gedung }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @error('id_gedung')
                <span class="error">{{ $message }}</span>
                @enderror

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit">
                    REGISTER
                </button>

            </form>

            <div class="login-link">
                Sudah punya akun?
                <a href="{{ route('login') }}">
                    Login
                </a>
            </div>

        </div>

    </div>

</body>
</html>