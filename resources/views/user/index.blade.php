@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Data User
        </h1>        
        <p class="subjudul">
            Kelola seluruh data user yang tersedia di LOGMED
        </p>
    </div>
</div>

<div class="toolbar">
    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>

        <form action="{{ route('user.index') }}" method="GET">
            <input type="text" name="search" placeholder="Pencarian..." value="{{ request('search') }}">
        </form>

    </div>

    <a href="{{ route('user.create') }}" class="btn-tambah">
        + Tambah User
    </a>

</div>

<table class="table-data">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Gedung</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($user as $item)

        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>
                @if($item->role == 'admin')
                    <span class="badge-admin">
                        Admin
                    </span>
                @else

                    <span class="badge-user">
                        User Gedung
                    </span>

                @endif
            </td>

            <td>
                {{ $item->gedung->nama_gedung ?? '-' }}
            </td>

           <td class="aksi">

                <a href="{{ route('user.edit', $item->id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i>
                </a>

                <a href="#" class="btn-delete" onclick="showDeleteModal('{{ route('user.destroy',$item->id) }}')">

                    <i class="fa-solid fa-trash"></i>
                </a>

            </td>
        </tr>

    @empty

        <tr>
            <td colspan="5">
                Belum ada data user.
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

        <h2>Hapus Data User</h2>
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

{{ $user->links() }}

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