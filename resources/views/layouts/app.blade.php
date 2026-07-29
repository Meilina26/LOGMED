<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGMED</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="{{ route('obat.index') }}" class="menu-item {{ request()->routeIs('obat.*') ? 'active' : '' }}">
                <i class="fa-solid fa-pills"></i>
                Data Obat
            </a>

            <a href="{{ route('gedung.index') }}" class="menu-item {{ request()->routeIs('gedung.*') ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i>
                Data Gedung
            </a>

            <a href="{{ route('distribusi.index') }}" class="menu-item {{ request()->routeIs('distribusi.*') ? 'active' : '' }}">
                <i class="fa-solid fa-truck-medical"></i>
                Distribusi
            </a>

            <a href="{{ route('monitoring.index') }}" class="menu-item {{ request()->routeIs('monitoring.*') ? 'active' : '' }}">
                <i class="fa-solid fa-boxes-stacked"></i>
                Monitoring Stok
            </a>

            <a href="{{ route('laporan.admin.index') }}" class="menu-item {{ request()->routeIs('laporan.admin.*') ? 'active' : '' }}">                
                <i class="fa-solid fa-file-lines"></i>
                Laporan
            </a>

            <a href="{{ route('user.index') }}" class="menu-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                Data User
            </a>
        </nav>

        <div class="profile">
            <i class="fa-solid fa-circle-user"></i>
            <h3>{{ Auth::user()->name }}</h3>
            <p>{{ Auth::user()->email }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
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

greeting.innerHTML = `${text}, Admin!`;

today.innerHTML = new Date().toLocaleDateString('id-ID',{
    weekday:'long',
    day:'numeric',
    month:'long',
    year:'numeric'
});
</script>

</body>
</html>