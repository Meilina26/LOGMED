<!DOCTYPE html>
<html>

<head>
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:13px;
        }

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        h4{
            text-align:center;
            margin-top:0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th,td{
            border:1px solid black;
            padding:8px;
            text-align:center;
        }

        .no-border{
            border:none;
            margin-top:15px;
        }

        .ttd{
            margin-top:70px;
            text-align:right;
        }
    </style>
</head>

<body>

    <h2>LOGMED</h2>

    <h4>FORM PENGGUNAAN OBAT</h4>

    <table class="no-border">

        <tr>
            <td class="no-border">
            Tanggal : ....................................
            </td>
            <td class="no-border">
            Nama Gedung : ....................................
            </td>
        </tr>

        <tr>
            <td class="no-border">
            Nama Petugas : ....................................
            </td>
        </tr>

    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>

        @for($i=1;$i<=10;$i++)

        <tr>
            <td>{{ $i }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        @endfor

        </tbody>
    </table>

    <div style="margin-top:25px;">

        <b>Catatan :</b>
        <br><br>

        _____________________________________________________

        <br><br>

        _____________________________________________________

    </div>

    <div class="ttd">
    Mengetahui,

    <br><br><br><br>

    (__________________)

    </div>
</body>
</html>