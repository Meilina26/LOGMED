@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Data Obat
        </h1>        
        <p class="subjudul">
            Kelola seluruh data obat yang tersedia.
        </p>
    </div>
</div>

<div class="toolbar">
    <form action="{{ route('obat.index') }}" method="GET" class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari obat...">
    </form>

    <a href="{{ route('obat.create') }}" class="btn-tambah">
        <i class="fa-solid fa-plus"></i>
        Tambah Obat
    </a>
</div>

<table class="table-data">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Obat</th>
            <th>Jenis Obat</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Expired</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($obat as $item)
        <tr>
            <td>{{ $item->kode_obat }}</td>
            <td>{{ $item->nama_obat }}</td>
            <td>{{ $item->jenis_obat }}</td>
            <td>{{ $item->satuan }}</td>
            <td>
                <strong>{{ $item->stok_pusat }}</strong>
                <br>
                <span class="badge {{ $item->badge_stok }}">
                    {{ $item->status_stok }}
                </span>
            </td>            
            <td>
                {{ \Carbon\Carbon::parse($item->expired_date)->format('d M Y') }}

                <br>

                <span class="badge {{ $item->badge_expired }}">
                    {{ $item->status_expired }}
                </span>
            </td>     
                   
            <td class="aksi">
                <a href="{{ route('obat.edit', $item->id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i>
                </a>

                <form action="{{ route('obat.destroy', $item->id) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf
                    @method('DELETE')

                   <a href="#"
                    class="btn-delete"
                    onclick="showDeleteModal('{{ route('obat.destroy',$item->id) }}')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" align="center">
                Belum ada data obat.
            </td>
        </tr>
    @endforelse

    </tbody>

</table>

<div class="pagination-wrapper">
    {{ $obat->appends(request()->query())->links() }}
</div>

<div id="deleteModal" class="modal">
    <div class="modal-box">
        <div class="modal-icon">
            <i class="fa-solid fa-trash"></i>
        </div>

        <h2>Hapus Data Obat</h2>

        <p>
            Apakah Anda yakin ingin menghapus data ini?
        </p>

        <div class="modal-action">

            <button class="btn-batal" onclick="closeModal()">
                Batal
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-hapus">
                    Hapus
                </button>

            </form>
        </div>
    </div>
</div>


<script>
function showDeleteModal(url){
    document.getElementById('deleteModal').style.display='flex';
    document.getElementById('deleteForm').action=url;
}

function closeModal(){
    document.getElementById('deleteModal').style.display='none';
}

window.onclick=function(e){
    if(e.target==document.getElementById('deleteModal')){
        closeModal();
    }
}
</script>
@endsection