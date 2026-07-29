<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokGedung extends Model
{
    protected $table = 'stok_gedung';

    protected $fillable = [
        'id_gedung',
        'id_obat',
        'jumlah_stok'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class,'id_obat');
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class,'id_gedung');
    }

    public function penggunaan()
    {
        return $this->hasMany(PenggunaanObat::class,'id_stok');
    }
}