@extends('admin.layouts.app')

@section('title', 'Espace Modérateur')

@section('content')
<h2 class="mb-4">Tableau de bord - Modérateur</h2>

<p class="text-muted">Vous pouvez valider les contenus, médias, commentaires et traductions.</p>

<div class="list-group">
    <a href="{{ route('admin.contenus.index') }}" class="list-group-item">
        Contenus en attente
    </a>
    <a href="{{ route('admin.medias.index') }}" class="list-group-item">
        Médias en attente
    </a>
    <a href="{{ route('admin.commentaires.index') }}" class="list-group-item">
        Commentaires en attente
    </a>
</div>
@endsection
