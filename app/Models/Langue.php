<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    protected $fillable = [
        'code',
        'nom',
        'description',
        'is_active',
        'icone'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function contenus()
    {
        return $this->hasMany(Contenu::class);
    }

    // Accessor pour récupérer l’icône (front + admin)
    public function getIconeUrlAttribute()
    {
        if (!$this->icone) {
            return asset('images/default-langue.png');
        }

        return asset('storage/' . $this->icone);
    }
}
