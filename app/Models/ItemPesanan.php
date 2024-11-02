<?php

namespace App\Models;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Model;

class ItemPesanan extends Model
{
    protected $table = 'item_pesanans';
    protected $primaryKey = 'idItemPesanan';

    protected $fillable = [
        'idPesanan',
        'idMenus',
        'jumlah',
        'harga',
        'subtotal'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->subtotal = $model->jumlah * $model->harga;
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'idMenus', 'idMenu');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'idPesanan', 'idPesanan');
    }
}
