<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'reference_id',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime'
    ];
}
