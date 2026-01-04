@extends('moderateur.layouts.app')

@section('title', 'Dashboard Modérateur')

@section('content')

<h2 class="fw-bold mb-4">Espace Modérateur</h2>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5>Contenus en attente</h5>
            <p class="display-6 text-warning">{{ $contenus_pending }}</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5>Médias en attente</h5>
            <p class="display-6 text-primary">{{ $medias_pending }}</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5>Commentaires en attente</h5>
            <p class="display-6 text-info">{{ $comment_pending }}</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5>Traductions en attente</h5>
            <p class="display-6 text-danger">{{ $traductions_pending }}</p>
        </div>
    </div>

</div>

@endsection
