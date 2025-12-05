<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TypeContenu extends Model
{
    protected $table = 'typecontenus';
    protected $fillable = ['nom'];

    public function contenus()
    {
        
        return $this->hasMany(Contenu::class, 'typecontenu_id');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->nom);
    }
}
