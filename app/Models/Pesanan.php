<?php

namespace App\Models;

use App\Models\Pengiriman;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';
    protected $primaryKey = 'idPesanan';

    protected $fillable = [
        'idUser',
        'idPengiriman',
        'tanggalPesanan',
        'status',
        'jumlahTotal',
        'tipePesanan'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $dates = [
        'tanggalPesanan',
        'created_at',
        'updated_at'
    ];

    // Change to hasMany since one pesanan can have multiple items
    public function itemPesanan()
    {
        return $this->hasMany(ItemPesanan::class, 'idPesanan', 'idPesanan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    // Add relationship to Pengiriman
    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'idPengiriman', 'idPengiriman');
    }
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'idPesanan', 'idPesanan');
    }

    // Helper method to calculate total
    public function calculateTotal()
    {
        $subtotal = $this->itemPesanan->sum('subtotal');

        // Add delivery fee if it's a delivery order
        if ($this->tipePesanan === 'delivery' && $this->pengiriman) {
            return $subtotal + $this->pengiriman->biayaPengiriman;
        }

        return $subtotal;
    }

    // Helper method to update status
    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
    }

    // Boot method to set tanggalPesanan automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pesanan) {
            if (!$pesanan->tanggalPesanan) {
                $pesanan->tanggalPesanan = now();
            }
        });
    }
}
