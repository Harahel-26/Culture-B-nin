<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';

    protected $fillable = [
        'reference',
        'user_id',
        'contenu_id',
        'montant',
        'devise',
        'gateway',
        'statut',
        'paye_le',
    ];

    protected $casts = [
        'montant' => 'float',
        'paye_le' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }

    public function scopePayes($query)
    {
        return $query->where('statut', 'paye');
    }

    public function estPaye(): bool
    {
        return $this->statut === 'paye';
    }
}
