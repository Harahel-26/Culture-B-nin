<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasAchats;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasApiTokens, Notifiable, HasRoles;
    use HasAchats;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'phone',
        'bio',
        'is_active',
        'is_admin',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
    ];

    public function contenus()
    {
        return $this->hasMany(Contenu::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(Contenu::class, 'favoris')->withTimestamps();
    }

    public function commentaires()
  {
        return $this->hasMany(Commentaire::class);
 }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function contenusAchetes()
    {
        return $this->belongsToMany(Contenu::class, 'paiements')
                    ->wherePivot('statut', 'paye')
                    ->withTimestamps();
    }

    public function aAcheteContenu($contenuId)
    {
        return $this->contenusAchetes()
                    ->where('contenu_id', $contenuId)
                    ->exists();
    }
    //traductions
    public function traductions()
    {
        return $this->hasMany(ContenuTraduction::class, 'traduit_par');
    }
    public function scopeActif($query)
{
    return $query->where('is_active', true);
}

// Scope pour les contributeurs
public function scopeContributeurs($query)
{
    return $query->whereHas('roles', function($q) {
        $q->where('name', 'contributeur');
    });
}

// Vérifie si l'utilisateur est actif
public function estActif()
{
    return $this->is_active;
}
}
