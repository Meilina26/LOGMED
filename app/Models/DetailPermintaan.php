<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    protected $table = 'detail_permintaan';

    protected $fillable = [
        'id_permintaan',
        'id_obat',
        'jumlah'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class,'id_obat');
    }

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class,'id_permintaan');
    }
}