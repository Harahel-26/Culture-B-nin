@extends('admin.layouts')

@section('title', 'Détails Type Média')

@section('content')

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-folder"></i> {{ $typemedia->nom }}
</h3>

<div class="card shadow-sm p-4">

    <p><strong>Nom :</strong> {{ $typemedia->nom }}</p>

    <p>
        <strong>Médias associés :</strong>
        <span class="badge bg-primary">{{ $typemedia->medias->count() }}</span>
    </p>

    <hr>

    <a href="{{ route('admin.typemedias.index') }}" class="btn btn-secondary">
        Retour
    </a>

</div>

@endsection
