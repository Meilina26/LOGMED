@extends('layouts.app-petugas')

@section('content')

<div class="page-header">
    <div>
        <h1 class="judul-halaman">
            Buat Permintaan Obat
        </h1>

        <p class="subjudul">
            Pilih obat yang ingin diajukan ke gudang pusat.
        </p>

    </div>
</div>

<div class="form-card">
<form action="{{ route('permintaan.store') }}" method="POST">

@csrf

    <div class="form-group">
        <label>Catatan</label>
        <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan (opsional)..."></textarea>
    </div>

<br>

@foreach($obat as $item)

<div class="obat-card">

    <div class="obat-header">
        <div>
            <h3>{{ $item->nama_obat }}</h3>
            <small>{{ $item->jenis_obat }}</small>
        </div>

        {!! $item->status_stok !!}
    </div>

    <p>
        <strong>Stok Gudang :</strong>
        {{ $item->stok_pusat }}
        {{ $item->satuan }}
    </p>

    @if($item->stok_pusat>0)

    <button type="button" class="btn-tambah-obat" onclick="toggleObat({{ $item->id }})">

        <i class="fa-solid fa-plus"></i>
        Tambah
    </button>

    <div id="box{{ $item->id }}" style="display:none;margin-top:15px;">
        <label>Jumlah Permintaan</label>
        <input type="number" class="form-control" name="obat[{{ $item->id }}]" min="1" value="1">
    </div>

    @else

    <button
        class="btn-habis" disabled>
        Stok Habis
    </button>

    @endif
</div>

@endforeach

<br>

<button class="btn-request">
    <i class="fa-solid fa-paper-plane"></i>
    Kirim Permintaan
</button>
</form>
</div>

<script>

function toggleObat(id){
    let box=document.getElementById("box"+id);
    if(box.style.display=="none"){
        box.style.display="block";
    }else{
        box.style.display="none";
    }
}

</script>

@endsection