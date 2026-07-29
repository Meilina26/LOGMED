<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Laporan LOGMED</title>
        <style>
            body{
                font-family: DejaVu Sans, sans-serif;
                font-size:12px;
                color:#333;
            }

            h1,h2,h3{
                margin:0;
            }

            .header{
                text-align:center;
                border-bottom:2px solid #000;
                padding-bottom:10px;
                margin-bottom:20px;
            }

            .info{
                margin-bottom:20px;
                line-height:1.8;
            }

            .summary{
                width:100%;
                border-collapse:collapse;
                margin-bottom:25px;
            }

            .summary td{
                border:1px solid #000;
                padding:8px;
            }

            .permintaan{
                margin-bottom:25px;
                border:1px solid #aaa;
                padding:15px;
            }

            .permintaan h3{
                margin-bottom:8px;
            }

            table{
                width:100%;
                border-collapse:collapse;
                margin-top:10px;
            }

            table th{
                background:#e9e9e9;
            }

            table,th,td{
                border:1px solid #000;
            }

            th,td{
                padding:8px;
            }

            .footer{
                margin-top:70px;
                text-align:right;
            }
        </style>
    </head>

    <body>

        <div class="header">
            <h1>LOGMED</h1>
            <h3>Sistem Distribusi Logistik Obat</h3>
            <h2>LAPORAN PENGAJUAN OBAT</h2>
        </div>

        <div class="info">
            <strong>Gedung :</strong>
            {{ auth()->user()->gedung->nama_gedung }}
            <br>
            <strong>Petugas :</strong>
            {{ auth()->user()->name }}
        <br>

            <strong>Tanggal Cetak :</strong>

            {{ now()->format('d F Y') }}

        </div>

        <table class="summary">
            <tr>
                <td>Total Pengajuan</td>
                <td>{{ $totalPengajuan }}</td>
            </tr>

            <tr>
                <td>Disetujui</td>
                <td>{{ $disetujui }}</td>
            </tr>

            <tr>
                <td>Ditolak</td>
                <td>{{ $ditolak }}</td>
            </tr>

            <tr>
                <td>Selesai</td>
                <td>{{ $selesai }}</td>
            </tr>

        </table>

            @foreach($permintaan as $item)

                <div class="permintaan">
                <h3>PRM{{ str_pad($item->id,3,'0',STR_PAD_LEFT) }}</h3>

                <p> <b>Tanggal :</b>
                    {{ $item->created_at->format('d M Y') }}
                </p>

                <p>
                    <b>Status :</b>
                    {{ ucfirst($item->status) }}
                </p>

                @if($item->catatan)

                <p>
                    <b>Catatan :</b>
                    {{ $item->catatan }}
                </p>

                @endif

        <table>
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                </tr>
            </thead>

            <tbody>

            @foreach($item->detail as $detail)

                <tr>
                    <td>{{ $detail->obat->nama_obat }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ $detail->obat->satuan }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

            @endforeach

            <div class="footer">
            <p>{{ now()->format('d F Y') }}</p>

            <br><br><br>

            <b> ( {{ auth()->user()->name }} ) </b>
        </div>
    </body>
</html>