<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailMenu extends Model
{
    protected $primaryKey = 'idDetailMenu';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'harga'
    ];
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_detail_menu', 'idDetailMenu', 'idMenu');
    }
}
