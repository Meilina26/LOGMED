<!DOCTYPE html>
<html>

    <head>

        <style>

            body{
                font-family:DejaVu Sans;
                font-size:12px;
            }

            h2{
                text-align:center;
            }

            table{
                width:100%;
                border-collapse:collapse;
                margin-top:20px;
            }

            th,td{
                border:1px solid #000;
                padding:8px;
            }

            th{
                background:#efefef;
            }

        </style>

    </head>

    <body>

        <h2>
            LAPORAN DISTRIBUSI OBAT
        </h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Gedung</th>
                    <th>Pemohon</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @foreach($permintaan as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->created_at->format('d-m-Y') }}
                    </td>
                    <td>
                        {{ $item->user->gedung->nama_gedung }}
                    </td>
                    <td>
                        {{ $item->user->name }}
                    </td>
                    <td>
                        {{ ucfirst($item->status) }}
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </body>

</html>