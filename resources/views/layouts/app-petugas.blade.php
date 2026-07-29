<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGMED - User</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/petugas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

<div class="layout">
    <aside class="sidebar">
        <div class="logo">
            <span class="log">LOG</span><span class="med">MED</span>
        </div>

        <nav class="menu">

    <a href="{{ route('petugas.dashboard') }}"
    class="menu-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>

    <a href="{{ route('permintaan.index') }}" class="menu-item {{ request()->routeIs('permintaan.*') ? 'active' : '' }}">
        <i class="fa-solid fa-notes-medical"></i>
        Permintaan Obat
    </a>

    <a href="{{ route('riwayat.index') }}" class="menu-item {{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
        <i class="fa-solid fa-clock-rotate-left"></i>
        Riwayat Permintaan
    </a>

    <a href="{{ route('stok-gedung.index') }}" class="menu-item {{ request()->routeIs('stok-gedung.*') ? 'active' : '' }}">
        <i class="fa-solid fa-warehouse"></i>
        Stok Gedung
    </a>

    <a href="{{ route('laporan.index') }}" class="menu-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
        <i class="fa-solid fa-file-lines"></i>
        Laporan
    </a>
</nav>

        <div class="profile">
            <i class="fa-solid fa-circle-user"></i>
            <h3>{{ Auth::user()->name }}</h3>
            <p>{{ Auth::user()->email }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    Logout
                </button>
            </form>

        </div>

    </aside>

    <main class="content">

        @yield('content')

    </main>

</div>

<script>
const greeting = document.getElementById('greeting');
const today = document.getElementById('today');

const hour = new Date().getHours();

let text = "Halo";

if(hour >= 5 && hour < 11){
    text = "🌞 Selamat Pagi";
}
else if(hour >= 11 && hour < 15){
    text = "☀️ Selamat Siang";
}
else if(hour >= 15 && hour < 18){
    text = "🌤 Selamat Sore";
}
else{
    text = "🌙 Selamat Malam";
}

greeting.innerHTML = `${text}, User Logmed!`;

today.innerHTML = new Date().toLocaleDateString('id-ID',{
    weekday:'long',
    day:'numeric',
    month:'long',
    year:'numeric'
});
</script>
</body>
</html>