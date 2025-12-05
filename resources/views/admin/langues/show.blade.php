@extends('admin.layouts')

@section('title', 'Détails Langue')

@section('content')

<h3 class="fw-bold mb-3">Détails de la langue : {{ $langue->nom }}</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <p><strong>Nom :</strong> {{ $langue->nom }}</p>
        <p><strong>Code :</strong> {{ $langue->code }}</p>

        <p><strong>Statut :</strong>
            @if($langue->is_active)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </p>

        <p><strong>Description :</strong></p>
        <p>{{ $langue->description ?? 'Aucune description' }}</p>

        <p><strong>Icône :</strong></p>
        <img src="{{ $langue->icone_url }}" width="80" height="80" class="rounded border">

        <hr>

        <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">
            Retour
        </a>

    </div>
</div>

@endsection
