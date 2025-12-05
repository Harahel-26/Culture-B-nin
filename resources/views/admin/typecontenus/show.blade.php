@extends('admin.layouts')

@section('title', 'Détails Type de Contenu')

@section('content')

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-folder2"></i> {{ $typecontenu->nom }}
</h3>

<div class="card shadow-sm p-4">

    <p><strong>Nom :</strong> {{ $typecontenu->nom }}</p>

    <p>
        <strong>Nombre de contenus associés :</strong>
        <span class="badge bg-primary">{{ $typecontenu->contenus->count() }}</span>
    </p>

    <hr>

    <a href="{{ route('admin.typecontenus.index') }}" class="btn btn-secondary">
        Retour
    </a>

</div>

@endsection
