@extends('layouts')

@section('content')
<div class="card">
    <div class="card-header">Détails de la langue</div>

    <div class="card-body">
        <p><strong>Code :</strong> {{ $langue->code }}</p>
        <p><strong>Nom :</strong> {{ $langue->nom }}</p>
        <p><strong>Description :</strong> {{ $langue->description }}</p>
        <p><strong>Active :</strong> {{ $langue->is_active ? 'Oui' : 'Non' }}</p>

        <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary mt-3">
            Retour
        </a>
    </div>
</div>
@endsection
