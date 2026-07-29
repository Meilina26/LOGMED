@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Data Gedung
        </h1>        
        <p class="subjudul">
            Kelola seluruh data gedung yang terdaftar di LOGMED
        </p>
    </div>
</div>

<div class="toolbar">

    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Pencarian...">
    </div>

    <a href="{{ route('gedung.create') }}" class="btn-tambah">
        + Tambah Gedung
    </a>

</div>

<table class="table-data">

    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Gedung</th>
            <th>Lokasi</th>
            <th>Jumlah User</th>
            <th>Penanggung Jawab</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($gedung as $item)

        <tr>

            <td>{{ $item->kode_gedung }}</td>
            <td>{{ $item->nama_gedung }}</td>
            <td>{{ $item->lokasi }}</td>
            <td>{{ $item->users_count }} User</td>
            <td>{{ $item->penanggung_jawab }}</td>
            <td class="aksi">
                <a href="{{ route('gedung.edit', $item->id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i>
                </a>

                <form action="{{ route('gedung.destroy', $item->id) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf
                    @method('DELETE')

                   <a href="#"
                    class="btn-delete"
                    onclick="showDeleteModal('{{ route('gedung.destroy',$item->id) }}')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </form>
            </td>

        </tr>

    @empty

        <tr>

            <td colspan="5">

                Belum ada data gedung.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

<div id="deleteModal" class="modal">
    <div class="modal-box">
        <div class="modal-icon">
            <i class="fa-solid fa-trash"></i>
        </div>

        <h2>Hapus Data Gedung</h2>

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

{{ $gedung->links() }}

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