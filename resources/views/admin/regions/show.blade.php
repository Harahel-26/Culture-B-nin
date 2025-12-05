@extends('admin.layouts')

@section('title', 'Détails Région')

@section('content')

<style>
    .detail-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1e1b4b;
    }
</style>

<h3 class="fw-bold mb-4 detail-title">
    📌 {{ $region->nom }}
</h3>

<div class="card shadow-sm p-4">

    <p><strong>Type :</strong> {{ $region->type ?? '—' }}</p>
    <p><strong>Langue principale :</strong>
        {{ $region->languePrincipale->nom ?? 'Aucune' }}
    </p>

    <p><strong>Description :</strong></p>
    <p>{{ $region->description ?? 'Aucune description disponible.' }}</p>

    <p><strong>Statut :</strong>
        @if($region->is_active)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </p>

    <hr>

    <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">
        Retour
    </a>

</div>

@endsection
