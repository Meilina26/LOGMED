<h2>Laporan Distribusi Obat</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="6">

    <tr>
        <th>Tanggal</th>
        <th>Gedung</th>
        <th>Pemohon</th>
        <th>Status</th>
    </tr>

    @foreach($permintaan as $item)

    <tr>
        <td>{{ $item->created_at->format('d-m-Y') }}</td>
        <td>{{ $item->user->gedung->nama_gedung }}</td>
        <td>{{ $item->user->name }}</td>
        <td>{{ ucfirst($item->status) }}</td>
    </tr>

    @endforeach

</table>