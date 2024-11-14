<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';
    protected $primaryKey = 'idPengiriman';

    protected $fillable = [
        'nama',
        'alamat',
        'catatan',
        'nomorTelepon',
        'biayaPengiriman',
        'status',
        'waktuPengiriman'
    ];

    protected $attributes = [
        'biayaPengiriman' => 100000,
        'status' => 'pending'
    ];

    protected $dates = ['waktuPengiriman'];

    public function pesanan()
    {
        return $this->hasOne(Pesanan::class, 'idPengiriman', 'idPengiriman');
    }
}
