<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contenu_id',
        'montant',
        'numero_telephone',
        'statut'
    ];

    protected $casts = [
        'montant' => 'decimal:2'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }

    // Méthode helper
    public function estPaye()
    {
        return $this->statut === 'paye';
    }

    // Format le numéro pour l'affichage
    public function getNumeroFormateAttribute()
    {
        $num = $this->numero_telephone;
        if (str_starts_with($num, '229')) {
            return '+229 ' . substr($num, 3);
        }
        return $num;
    }
}
