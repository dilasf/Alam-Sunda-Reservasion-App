<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';
    protected $primaryKey = 'idLaporan';

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'idTransaksi');
    }
}
