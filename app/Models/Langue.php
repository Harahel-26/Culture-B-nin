<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    protected $fillable = [
        'code',
        'nom',
        'description',
        'is_active'
    ];
     public function contenus()
    {
        return $this->hasMany(Contenu::class);
    }

}
