<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Obat extends Model
{
    protected $table = 'obat';

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'jenis_obat',
        'satuan',        
        'stok_pusat',
        'expired_date',
    ];

    public function getStatusStokAttribute()
    {
        if ($this->stok_pusat > 20) {
            return 'Aman';
        }

        if ($this->stok_pusat > 5) {
            return 'Hampir Habis';
        }

        return 'Menipis';
    }

    public function getBadgeStokAttribute()
    {
        if ($this->stok_pusat > 20) {
            return 'badge-success';
        }

        if ($this->stok_pusat > 5) {
            return 'badge-warning';
        }

        return 'badge-danger';
    }

    public function getStatusExpiredAttribute()
    {
        $today = Carbon::today();
        $expired = Carbon::parse($this->expired_date);

        $days = $today->diffInDays($expired, false);

        if ($days < 0) {
            return 'Expired';
        }

        if ($days <= 30) {
            return $days.' Hari Lagi';
        }

        return 'Aman';
    }

    public function getBadgeExpiredAttribute()
    {
        $today = Carbon::today();
        $expired = Carbon::parse($this->expired_date);

        $days = $today->diffInDays($expired, false);

        if ($days < 0) {
            return 'badge-danger';
        }

        if ($days <= 30) {
            return 'badge-warning';
        }

        return 'badge-success';
    }

    public function detailPermintaan()
    {
        return $this->hasMany(DetailPermintaan::class,'id_obat');
    }
}
