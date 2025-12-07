@extends('front.layouts.app')

@section('title', 'Devenir Contributeur')

@section('content')

<h2 class="fw-bold mb-4">Devenir Contributeur</h2>

@if($demande)

    @if($demande->statut === 'pending')
        <div class="alert alert-warning">
            Votre demande est en attente de traitement.
        </div>
    @elseif($demande->statut === 'accepted')
        <div class="alert alert-success">
            Félicitations ! Votre demande a été acceptée. Vous êtes maintenant contributeur.
        </div>
    @else
        <div class="alert alert-danger">
            Votre demande a été rejetée.
        </div>
    @endif

@else

<form method="POST" action="{{ route('front.devenir.store') }}" class="card p-4 shadow-sm">
    @csrf

    <h4 class="fw-bold mb-3">Pourquoi souhaitez-vous devenir contributeur ?</h4>

    <textarea name="motivation" class="form-control mb-3" rows="5"
              placeholder="Expliquez brièvement vos raisons (facultatif)..."></textarea>

    <button class="btn btn-gold">
        Envoyer ma demande
    </button>
</form>

@endif

@endsection
