@extends('front.layouts.app')

@section('title', 'Espace Contributeur')

@section('content')

<h2 class="fw-bold mb-4">Espace Contributeur</h2>

<div class="row g-4">

    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">Mes contenus</h5>
            <p class="display-6">{{ $total_contenus }}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">En attente</h5>
            <p class="display-6 text-warning">{{ $en_attente }}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">Validés</h5>
            <p class="display-6 text-success">{{ $valides }}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">Rejetés</h5>
            <p class="display-6 text-danger">{{ $rejetes }}</p>
        </div>
    </div>

</div>

<a href="{{ route('contributeur.contenus.create') }}"
   class="btn btn-gold mt-4">
   <i class="bi bi-plus-circle"></i> Ajouter un contenu
</a>

@endsection
