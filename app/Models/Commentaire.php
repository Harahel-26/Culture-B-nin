<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu_id',
        'user_id',
        'note',
        'commentaire',
        'statut',
    ];

    protected $casts = [
        'note' => 'integer',
    ];

    /**
     * Relation avec le contenu
     */
    public function contenu(): BelongsTo
    {
        return $this->belongsTo(Contenu::class);
    }

    /**
     * Relation avec l'utilisateur
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope pour les commentaires validés
     */
    public function scopeValides($query)
    {
        return $query->where('statut', 'validated');
    }

    /**
     * Scope pour les commentaires en attente
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'pending');
    }

    /**
     * Vérifie si le commentaire est validé
     */
    public function estValide(): bool
    {
        return $this->statut === 'validated';
    }

    /**
     * Étoiles pour l'affichage
     */
    public function etoiles(): string
    {
        $etoiles = '';
        for ($i = 1; $i <= 5; $i++) {
            $etoiles .= $i <= $this->note ? '★' : '☆';
        }
        return $etoiles;
    }

    /**
     * Formate la date de création
     */
    public function getDateFormateeAttribute(): string
    {
        return $this->created_at->format('d/m/Y à H:i');
    }
}
