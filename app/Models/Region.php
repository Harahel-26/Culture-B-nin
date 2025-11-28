<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'nom',
        'type',
        'description',
        'langue_principale',
        'is_active',
    ];
}
