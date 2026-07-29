@extends('layouts.app-petugas')

@section('content')

<div class="dashboard-header">
    <div>
        <h1 id="greeting">Halo, {{ Auth::user()->name }}!</h1>
        <p id="today"></p>
    </div>
</div>

<!-- Welcome -->
<div class="welcome-card">

    <div class="welcome-text">
        <h2>Hello, {{ Auth::user()->name }}!</h2>
        <p>
            Great to see you here,
            let's finish what you start before.
            <br>
            Keep Spirit!
        </p>
    </div>

    <div class="welcome-image">
        <img src="{{ asset('images/welcome.png') }}" alt="Welcome">
    </div>

</div>
    
<div class="card-dashboard">
    <div class="card-item">
        <i class="fa-solid fa-hourglass-half"></i>
        <h2>{{ $menunggu }}</h2>
        <p>Permintaan Menunggu</p>
    </div>

    <div class="card-item">
        <i class="fa-solid fa-truck-fast"></i>
        <h2>{{ $diproses }}</h2>
        <p>Sedang Diproses</p>
    </div>

    <div class="card-item">
        <i class="fa-solid fa-box-open"></i>
        <h2>{{ $diterima }}</h2>
        <p>Penerimaan</p>
    </div>
</div>
</div>

@endsection