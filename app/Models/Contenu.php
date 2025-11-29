<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contenu extends Model
{
    protected $fillable = [
        'titre',
        'slug',
        'description',
        'contenu_texte',
        'image_couverture',
        'langue_id',
        'region_id',
        'typecontenu_id',
        'user_id',
        'validated_by',
        'status',
        'is_active',
    ];

    // Slug automatique lors de la création
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contenu) {
            if (empty($contenu->slug)) {
                $contenu->slug = Str::slug($contenu->titre) . '-' . uniqid();
            }
        });
    }

    // Relations
    public function langue()
    {
        return $this->belongsTo(Langue::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function typecontenu()
    {
        return $this->belongsTo(TypeContenu::class);
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function traductions()
    {
        return $this->hasMany(ContenuTraduction::class);
    }
    public function commentaires()
{
    return $this->hasMany(Commentaire::class);
}

// Note moyenne ⭐⭐⭐⭐✰
public function moyenneNotes()
{
    return $this->commentaires()
                ->where('statut', 'validated')
                ->avg('note');
}

// Nombre de votes
public function totalNotes()
{
    return $this->commentaires()
                ->where('statut', 'validated')
                ->count();
}

}
