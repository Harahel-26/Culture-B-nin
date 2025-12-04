<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\User;

class ContenuTraduction extends Model
{
    use HasFactory;

    protected $table = 'contenu_traductions';

    protected $fillable = [
        'contenu_id',
        'langue_id',
        'traduit_par',
        'titre',
        'description',
        'contenu_texte',
        'status',
        'validated_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Contenu d’origine
    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }

    // Langue cible (ex : français → fon)
    public function langue()
    {
        return $this->belongsTo(Langue::class);
    }


    // Utilisateur qui a créé la traduction
    public function traducteur()
    {
        return $this->belongsTo(User::class, 'traduit_par');
    }

    // Utilisateur qui valide la traduction
    public function validateur()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
