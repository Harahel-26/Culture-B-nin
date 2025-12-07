<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeContributeur extends Model
{
    protected $fillable = [
        'user_id',
        'motivation',
        'statut',
        'traite_par'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function moderateur()
    {
        return $this->belongsTo(User::class, 'traite_par');
    }
}
