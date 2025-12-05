@extends('layout_projet')

@section('title', 'Détails du Média')

@section('content')

<style>
    .preview-large {
        width: 100%;
        max-height: 420px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.15);
        margin-bottom: 20px;
    }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-eye"></i> Aperçu du Média
</h3>

<div class="card p-4 shadow-sm">

    <!-- APERÇU -->
    @if($media->typeMedia->nom === 'image')
        <img src="{{ $media->url }}" class="preview-large">

    @elseif($media->typeMedia->nom === 'video')
        <video class="preview-large" controls>
            <source src="{{ $media->url }}">
        </video>

    @elseif($media->typeMedia->nom === 'audio')
        <audio controls class="w-100 mb-3">
            <source src="{{ $media->url }}">
        </audio>
    @endif

    <h4>{{ $media->titre ?? 'Sans titre' }}</h4>
    <p class="text-muted">{{ $media->description }}</p>

    <p><strong>Type :</strong> {{ $media->typeMedia->nom }}</p>
    <p><strong>Langue :</strong> {{ $media->langue->nom ?? 'Aucune' }}</p>
    <p><strong>Taille :</strong> {{ $media->taille }} KB</p>
    <p><strong>Status :</strong> {{ $media->status }}</p>
    <p><strong>Uploader :</strong> {{ $media->uploader->name }}</p>

    <div class="mt-3">
        <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary">
            Retour
        </a>
    </div>

</div>

@endsection
