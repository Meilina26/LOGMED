<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenggunaanObat extends Model
{
    protected $table = 'penggunaan_obat';

    protected $fillable = [
        'id_stok',
        'jumlah',
        'keterangan'
    ];

    public function stokGedung()
    {
        return $this->belongsTo(StokGedung::class, 'id_stok');
    }
}