<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeRole extends Model
{
    protected $fillable = [
        'user_id',
        'role_demande',
        'motif',
        'status',
        'validated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

