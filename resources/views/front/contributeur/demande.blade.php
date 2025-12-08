@extends('front.layouts.app')

@section('title', 'Demande pour devenir contributeur')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Demande pour devenir contributeur</h2>

    <p class="text-muted mb-4">
        En tant que contributeur, vous pourrez proposer des contenus, des médias et des traductions.
    </p>

    <form action="{{ route('front.contributeur.demande.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Pourquoi souhaitez-vous devenir contributeur ?</label>
            <textarea name="motif" rows="4" class="form-control" placeholder="Expliquez brièvement...">{{ old('motif') }}</textarea>
        </div>

        <button class="btn btn-gold">
            Envoyer la demande
        </button>
    </form>
</div>
@endsection
