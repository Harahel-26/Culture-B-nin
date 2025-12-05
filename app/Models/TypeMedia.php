<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TypeMedia extends Model
{
    protected $table = 'typemedias';
    protected $fillable = ['nom'];

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->nom);
    }
}
