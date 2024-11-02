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
        'status'
    ];

    protected $attributes = [
        'biayaPengiriman' => 150000,
        'status' => 'pending'
    ];

    public function pesanan()
    {
        return $this->hasOne(Pesanan::class, 'idPengiriman', 'idPengiriman');
    }
}
