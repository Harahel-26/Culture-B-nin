<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Region extends Model
{
    protected $fillable = [
        'nom',
        'type',
        'description',
        'langue_principale_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function languePrincipale()
    {
        return $this->belongsTo(Langue::class, 'langue_principale_id');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->nom);
    }
}
