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

    // AJOUTER CES RELATIONS :
    public function languePrincipale()
    {
        return $this->belongsTo(Langue::class, 'langue_principale', 'id');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class);
    }

    // Pour le slug (optionnel mais utile)
    public function getSlugAttribute()
    {
        return \Illuminate\Support\Str::slug($this->nom);
    }
}
