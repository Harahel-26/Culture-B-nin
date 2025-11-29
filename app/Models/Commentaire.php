<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu_id',
        'user_id',
        'note',
        'commentaire',
        'parent_id',
        'statut',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Le contenu concerné
    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }

    // Auteur du commentaire
    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Commentaire parent (si réponse)
    public function parent()
    {
        return $this->belongsTo(Commentaire::class, 'parent_id');
    }

    // Réponses
    public function reponses()
    {
        return $this->hasMany(Commentaire::class, 'parent_id');
    }

    // Vérifie si approuvé
    public function scopeApprouves($query)
    {
        return $query->where('statut', 'validated');
    }
}
