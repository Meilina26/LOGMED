@extends('layouts.app')

@section('content')

<div class="dashboard">

    <div class="dashboard-header">
        <div>
            <h1 id="greeting">
                Halo, {{ Auth::user()->name }}!
            </h1>

            <p id="today"></p>
        </div>
    </div>

    {{-- Welcome --}}
    <div class="welcome-card">

        <div class="welcome-text">

            <h2>
                Hello, {{ Auth::user()->name }}!
            </h2>

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


    {{-- Statistik --}}
    <div class="stats">

        <div class="stat-card">

            <div class="icon obat">
                <i class="fa-solid fa-pills"></i>
            </div>

            <div>
                <h4>Total Obat</h4>
                <h2>{{ $totalObat }}</h2>
            </div>

        </div>

        <div class="stat-card">

            <div class="icon gedung">
                <i class="fa-solid fa-building"></i>
            </div>

            <div>
                <h4>Gedung</h4>
                <h2>{{ $totalGedung }}</h2>
            </div>

        </div>


        <div class="stat-card">

            <div class="icon distribusi">
                <i class="fa-solid fa-users"></i>
            </div>

            <div>
                <h4>Total User</h4>
                <h2>{{ $totalUser }}</h2>
            </div>

        </div>

    </div>


    {{-- Grafik --}}
    <div class="charts">
        <div class="chart-card">
            <h3>
                Distribusi Obat per Bulan
            </h3>
            <canvas id="chartDistribusi"></canvas>
        </div>


       <div class="chart-card">
            <h3>Status Permintaan</h3>
            <canvas id="chartStatus"></canvas>
        </div>
    </div>


{{-- Ringkasan --}}
<div class="bottom-cards">
    <div class="info-card pending">
        <div class="info-icon">
            <i class="fa-solid fa-clock"></i>
        </div>

        <div class="info-content">
            <span>Menunggu</span>

            <h2>{{ $status['menunggu'] }}</h2>

            <small>
                Permintaan belum diproses
            </small>
        </div>
    </div>


    <div class="info-card success">
        <div class="info-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="info-content">
            <span>Distribusi Selesai</span>
            <h2>{{ $status['selesai'] }}</h2>
            <small>
                Distribusi berhasil dilakukan
            </small>
        </div>
    </div>


    <div class="info-card danger">
        <div class="info-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <div class="info-content">
            <span>Stok Menipis</span>

            <h2>{{ $stokMenipis->count() }}</h2>

            <small>
                Segera lakukan restok
            </small>
        </div>
    </div>
</div>

   
<div class="recent-card" style="margin-top:30px;">

    <h2 style="margin-bottom:18px;">
        Pengajuan Terbaru
    </h2>

    <table class="table-data">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Gedung</th>
                <th>Pemohon</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @forelse($notifikasi as $item)

                <tr>
                    <td>
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td>
                        {{ $item->user->gedung->nama_gedung }}
                    </td>
                    <td>
                        {{ $item->user->name }}
                    </td>
                    <td>
                        <span class="badge-status
                            @if($item->status=='menunggu') warning
                            @elseif($item->status=='disetujui') info
                            @elseif($item->status=='selesai') success
                            @else danger
                            @endif">

                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4">
                        Tidak ada pengajuan terbaru.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>
</div>
</div>

<script>

const bulan = @json($bulan);
const distribusi = @json($jumlahDistribusi);

new Chart(document.getElementById('chartDistribusi'),{

    type:'line',

    data:{

        labels:bulan,

        datasets:[{

            label:'Distribusi',

            data:distribusi,

            borderColor:'#6FAE3F',

            backgroundColor:'rgba(111,174,63,.15)',

            fill:true,

            tension:.4,

            pointRadius:5,

            pointBackgroundColor:'#6FAE3F'

        }]

    },

    options:{
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{
                display:false
            }
        }
    }

});

new Chart(document.getElementById('chartStatus'),{

    type:'doughnut',

    data:{

        labels:[
            'Menunggu',
            'Disetujui',
            'Selesai',
            'Ditolak'
        ],

        datasets:[{

            data:[
                {{ $status['menunggu'] }},
                {{ $status['disetujui'] }},
                {{ $status['selesai'] }},
                {{ $status['ditolak'] }}
            ],

            backgroundColor:[
                '#F6C23E',
                '#36A2EB',
                '#1CC88A',
                '#E74A3B'
            ],

            borderWidth:2

        }]

    },

    options:{
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{
                position:'bottom'
            }
        },
        cutout:'70%'
    }

});
</script>

@endsection