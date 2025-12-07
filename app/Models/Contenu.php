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
        'max_vues_gratuites',
        'vues_gratuites',
        'vues_total',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_premium' => 'boolean',
        'prix' => 'decimal:2',
        'published_at' => 'datetime',
    ];

    protected $appends = [
        'prix_formatte',
        'est_accessible',
        'extrait',
        'moyenne_notes',
        'total_notes',
    ];

    /*
    |--------------------------------------------------------------------------
    | Boot : génération slug unique
    |--------------------------------------------------------------------------
    */
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

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class)->where('statut', 'validated');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
    public function traductions()
{
    return $this->hasMany(ContenuTraduction::class);
}


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeValides($q)
    {
        return $q->where('status', 'validated');
    }

    public function scopePremium($q)
    {
        return $q->where('is_premium', true);
    }

    public function scopeGratuit($q)
    {
        return $q->where('is_premium', false);
    }

    public function scopeAccessible($q, $user = null)
    {
        if (!$user) {
            return $q->where('is_premium', false);
        }

        if ($user->hasRole(['admin', 'moderateur'])) {
            return $q;
        }

        $ids = $user->contenusAchetes()->pluck('contenu_id');

        return $q->where(function ($sub) use ($ids) {
            $sub->where('is_premium', false)
                ->orWhereIn('id', $ids);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors (Champs Virtuels)
    |--------------------------------------------------------------------------
    */

    public function getPrixFormatteAttribute()
    {
        if (!$this->is_premium) {
            return 'Gratuit';
        }
        return number_format($this->prix, 0, ',', ' ') . ' FCFA';
    }

    public function getEstAccessibleAttribute()
    {
        if (!$this->is_premium) {
            return true;
        }

        $user = auth()->user();
        if (!$user) return false;

        return $user->aAcheteContenu($this->id)
            || $user->hasRole(['admin', 'moderateur']);
    }

    public function getExtraitAttribute()
    {
        if ($this->extrait_gratuit) {
            return $this->extrait_gratuit;
        }

        if ($this->description) {
            return Str::limit(strip_tags($this->description), 200);
        }

        return Str::limit(strip_tags($this->contenu_texte), 200);
    }

    public function getMoyenneNotesAttribute()
    {
        return round($this->commentaires()->avg('note') ?? 0, 1);
    }

    public function getTotalNotesAttribute()
    {
        return $this->commentaires()->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Méthodes Métiers
    |--------------------------------------------------------------------------
    */

    public function incrementerVues()
    {
        $this->increment('vues_total');
    }

    public function incrementerVuesGratuites()
    {
        $this->increment('vues_gratuites');
    }

    public function vuesGratuitesRestantes()
    {
        return max(0, $this->max_vues_gratuites - $this->vues_gratuites);
    }
}
