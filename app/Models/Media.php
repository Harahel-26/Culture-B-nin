<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
    protected $fillable = [
        'contenu_id', 'type_media_id', 'langue_id',
        'titre', 'description', 'fichier', 'extension',
        'taille', 'uploaded_by', 'validated_by', 'status'
    ];

    public function contenu() {
        return $this->belongsTo(Contenu::class);
    }

    public function typeMedia() {
        return $this->belongsTo(TypeMedia::class);
    }

    public function langue() {
        return $this->belongsTo(Langue::class);
    }

    public function uploader() {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function validateur() {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
