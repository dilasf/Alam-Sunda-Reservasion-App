<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'mejas';
    protected $primaryKey = 'idMeja';

    protected $fillable = [
        'nama',
        'jumlahPengunjung',
        'status',
        'lokasi'
    ];
    const STATUS_TERSEDIA = 'Tersedia';
    const STATUS_TIDAK_TERSEDIA = 'Tidak Tersedia';

    // Method untuk mendapatkan semua kemungkinan status
    public static function getStatusOptions()
    {
        return [
            self::STATUS_TERSEDIA => 'Tersedia',
            self::STATUS_TIDAK_TERSEDIA => 'Tidak Tersedia'
        ];
    }
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'idMeja', 'idMeja');
    }
}
