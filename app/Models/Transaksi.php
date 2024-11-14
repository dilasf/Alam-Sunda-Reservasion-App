<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Transaksi extends Model
{
    protected $primaryKey = 'idTransaksi';
    protected $guarded = ['idTransaksi'];

    // Definisi konstanta status
    const STATUS_PENDING = 'pending';
    const STATUS_DIBAYAR = 'dibayar';
    const STATUS_VERIFIED = 'diverifikasi';
    const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'idReservasi',
        'fotoBukti',
        'tanggal',
        'totalPembayaran',
        'totalDibayar',
        'status',
        'idPesanan',
    ];

    // Relasi ke model Reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'idReservasi', 'idReservasi');
    }
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'idPesanan', 'idPesanan');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'idTransaksi');
    }

    // Method untuk cek status
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isDibayar()
    {
        return $this->status === self::STATUS_DIBAYAR;
    }

    public function isVerified()
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    public function isDitolak()
    {
        return $this->status === self::STATUS_DITOLAK;
    }

    // Method untuk update status
    public function markAsDibayar()
    {
        $this->update(['status' => self::STATUS_DIBAYAR]);
    }

    // Method untuk mendapatkan path foto bukti
    public function getBuktiUrl()
    {
        if (!$this->fotoBukti) {
            return null;
        }
        return Storage::url('public/bukti_pembayaran/' . $this->fotoBukti);
    }


}
