<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PenggunaanObat;
use App\Models\StokGedung;

class Gedung extends Model
{
    protected $table = 'gedung';

    protected $fillable = [
        'kode_gedung',
        'nama_gedung',
        'lokasi',
        'penanggung_jawab'
    ];

    public function users()
    {
        return $this->hasMany(User::class,'id_gedung');
    }

    public function stokGedung()
    {
        return $this->hasMany(StokGedung::class, 'id_gedung');
    }

    public function penggunaanObat()
    {
        return $this->hasManyThrough(
            PenggunaanObat::class,
            StokGedung::class,
            'id_gedung',
            'stok_gedung_id',
            'id',
            'id'
        );
    }
}