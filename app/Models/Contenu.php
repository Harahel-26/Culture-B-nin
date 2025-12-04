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
        'is_premium',
        'prix',
        'extrait_gratuit',
        'vues_gratuites',
        'published_at',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'prix' => 'decimal:2',
        'published_at' => 'datetime',
    ];

    protected $appends = ['extrait', 'prix_formatte', 'est_accessible'];

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Contenus validés
    public function scopeValides($query)
    {
        return $query->where('status', 'validated');
    }

    // Contenus en attente
    public function scopeEnAttente($query)
    {
        return $query->where('status', 'pending');
    }

    // Contenus premium
    public function scopePremium($query)
    {
        return $query->where('is_premium', true);
    }

    // Contenus gratuits
    public function scopeGratuit($query)
    {
        return $query->where('is_premium', false);
    }

    // Contenus accessibles à l'utilisateur
    public function scopeAccessible($query, $user = null)
    {
        if (!$user) {
            return $query->where('is_premium', false);
        }

        if ($user->hasRole(['admin', 'moderateur'])) {
            return $query;
        }

        $contenusAchetes = $user->contenusAchetes()->pluck('contenu_id');

        return $query->where(function ($q) use ($contenusAchetes) {
            $q->where('is_premium', false)
              ->orWhereIn('id', $contenusAchetes);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

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

    public function utilisateur()
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
        return $this->hasMany(Commentaire::class)->where('statut', 'validated');
    }

    public function touscommentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accesseurs
    |--------------------------------------------------------------------------
    */

    // Vérifie si le contenu est accessible à l'utilisateur actuel
    public function getEstAccessibleAttribute()
    {
        if (!$this->is_premium) {
            return true;
        }

        $user = auth()->user();
        if (!$user) {
            return false;
        }

        return $user->aAcheteContenu($this->id) ||
               $user->hasRole(['admin', 'moderateur', 'contributeur_premium']);
    }

    // Formate le prix du contenu
    public function getPrixFormateAttribute()
    {
        if (!$this->is_premium) {
            return 'Gratuit';
        }
        return number_format($this->prix, 0, ',', ' ') . ' FCFA';
    }

    // Génère un extrait intelligent du contenu
    public function getExtraitAttribute()
    {
        if ($this->extrait_gratuit) {
            return $this->extrait_gratuit;
        }

        if ($this->description) {
            return Str::limit($this->description, 300);
        }

        // Extrait intelligent (premier paragraphe ou 300 caractères)
        $texte = strip_tags($this->contenu_texte);
        $sentences = explode('.', $texte);

        if (count($sentences) > 1) {
            $extrait = $sentences[0] . '.';
            if (strlen($extrait) < 100 && isset($sentences[1])) {
                $extrait .= ' ' . $sentences[1] . '.';
            }
            return Str::limit($extrait, 350);
        }

        return Str::limit($texte, 300);
    }

    /*
    |--------------------------------------------------------------------------
    | Méthodes
    |--------------------------------------------------------------------------
    */

    // Vérifie si l'utilisateur a acheté ce contenu
    public function estAchetePar($user = null)
    {
        if (!$user) {
            return false;
        }

        return $this->paiements()
            ->where('user_id', $user->id)
            ->where('statut', 'paye')
            ->exists();
    }

    // Calcul moyenne des notes
    public function moyenneNotes()
    {
        return $this->commentaires()
            ->where('statut', 'validated')
            ->avg('note') ?? 0;
    }

    // Nombre total de votes/commentaires
    public function totalNotes()
    {
        return $this->commentaires()
            ->where('statut', 'validated')
            ->count();
    }

    // Incrémente le nombre de vues gratuites
    public function incrementerVuesGratuites()
    {
        $this->increment('vues_gratuites');
    }

    // Calcule le pourcentage de vues gratuites utilisées
    public function pourcentageVueGratuite()
    {
        $maxVues = 3; // Nombre max de vues gratuites autorisées
        return min(($this->vues_gratuites / $maxVues) * 100, 100);
    }
}
