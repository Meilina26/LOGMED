<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Login LOGMED</title>
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>

    <body>
        <div class="container">
            <div class="left">
                <h1>Hello,<br>Welcome To LogMed!</h1>
                <p>Silahkan masuk ke akun Anda.</p>

                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                            
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-box">
                        <i class="fa-solid fa-user"></i>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                required
                            >  
                            @error('email')
                                <small style="color:red">{{ $message }}</small>
                            @enderror                  
                    </div>

                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                        >
                        @error('password')
                            <small style="color:red">{{ $message }}</small>
                        @enderror                    
                     </div>
                    <button type="submit">LOGIN</button>
                </form>

                <p class="register">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}">Register</a>
                </p>
            </div>

            <div class="right">
                <h2 class="logo">
                    <span class="log">LOG</span><span class="med">MED</span>
                </h2>                
                <img src="{{ asset('images/login.png') }}">
            </div>
        </div>

    </body>
</html>