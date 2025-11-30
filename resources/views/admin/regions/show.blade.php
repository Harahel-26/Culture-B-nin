@extends('layouts')

@section('content')
<div class="card">
    <div class="card-header">Détails de la région</div>

    <div class="card-body">
        <p><strong>Nom :</strong> {{ $region->nom }}</p>
        <p><strong>Type :</strong> {{ $region->type }}</p>
        <p><strong>Langue principale :</strong> {{ $region->langue_principale }}</p>
        <p><strong>Description :</strong> {{ $region->description }}</p>
        <p><strong>Active :</strong> {{ $region->is_active ? 'Oui' : 'Non' }}</p>

        <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary mt-3">
            Retour
        </a>
    </div>
</div>
@endsection
