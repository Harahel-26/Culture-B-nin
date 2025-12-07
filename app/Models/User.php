<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'phone',
        'bio',
        'adresse',
        'is_active',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    /** Relations */
    public function contenus()
    {
        return $this->hasMany(Contenu::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(Contenu::class, 'favoris')->withTimestamps();
    }

    public function traductions()
    {
        return $this->hasMany(ContenuTraduction::class, 'traduit_par');
    }

    /** Accessor avatar */
    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return asset('adminlte/img/user2-160x160.jpg');
        }
        return asset('storage/' . $this->avatar);
    }

    /** Scopes professionnels */
    public function scopeActifs($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeContributeurs($query)
    {
        return $query->whereHas('roles', fn($q) => $q->where('name', 'contributeur'));
    }

    public function estActif()
    {
        return $this->is_active;
    }
    public function contenusAchetes()
{
    return $this->belongsToMany(Contenu::class, 'paiements')
                ->wherePivot('statut', 'paye')
                ->withTimestamps();
}

}
