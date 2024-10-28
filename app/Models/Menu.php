<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'idMenu';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = ['nama', 'harga', 'gambar'];

    public function detailMenus()
    {
        return $this->belongsToMany(DetailMenu::class, 'menu_detail_menu', 'idMenu', 'idDetailMenu');
    }
}
