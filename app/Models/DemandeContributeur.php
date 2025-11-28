<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeContributeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motif',
        'status',
        'validated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
