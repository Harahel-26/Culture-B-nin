@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Détails du média</h3>
    </div>

    <div class="card-body">

        {{-- Aperçu --}}
        <div class="mb-3">
            <label class="form-label">Aperçu :</label><br>

            @if(in_array($media->extension, ['jpg','jpeg','png']))
                <img src="{{ asset('storage/'.$media->fichier) }}" width="300" class="rounded shadow">
            @elseif(in_array($media->extension, ['mp4','mov','avi']))
                <video width="300" controls>
                    <source src="{{ asset('storage/'.$media->fichier) }}">
                </video>
            @elseif(in_array($media->extension, ['mp3','wav']))
                <audio controls>
                    <source src="{{ asset('storage/'.$media->fichier) }}">
                </audio>
            @else
                <a href="{{ asset('storage/'.$media->fichier) }}" target="_blank">
                    <i class="fas fa-file fa-3x"></i>
                </a>
            @endif
        </div>

        <hr>

        <p><strong>Titre :</strong> {{ $media->titre ?? '—' }}</p>
        <p><strong>Description :</strong> {{ $media->description ?? '—' }}</p>
        <p><strong>Contenu lié :</strong> {{ $media->contenu->titre }}</p>
        <p><strong>Type de média :</strong> {{ $media->typeMedia->nom }}</p>
        <p><strong>Langue :</strong> {{ $media->langue->nom ?? '—' }}</p>
        <p><strong>Uploadé par :</strong> {{ $media->uploader->name }}</p>
        <p><strong>Taille :</strong> {{ round($media->taille, 2) }} KB</p>
        <p><strong>Status :</strong>
            @if($media->status == 'pending')
                <span class="badge bg-warning">En attente</span>
            @elseif($media->status == 'validated')
                <span class="badge bg-success">Validé</span>
            @else
                <span class="badge bg-danger">Rejeté</span>
            @endif
        </p>

        <a href="{{ route('medias.index') }}" class="btn btn-secondary mt-2">
            <i class="fas fa-arrow-left"></i> Retour
        </a>

        <a href="{{ route('medias.edit', $media) }}" class="btn btn-warning mt-2">
            <i class="fas fa-edit"></i> Modifier
        </a>

    </div>

</div>

@endsection
