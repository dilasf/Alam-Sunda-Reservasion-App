<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasis';
    protected $primaryKey = 'idReservasi';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'email',
        'no_telepon',
        'idUsers',
        'idMeja',
        'tanggal',
        'jumlahPengunjung',
        'status'
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'idMeja', 'idMeja');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUsers', 'id');
    }
}
