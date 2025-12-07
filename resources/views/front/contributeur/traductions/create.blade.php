@extends('front.layouts.app')

@section('title', 'Ajouter une traduction')

@section('content')

<h2 class="fw-bold mb-4">Traduction du contenu :</h2>

<div class="card shadow-sm p-4">

    <h4 class="mb-3">{{ $contenu->titre }}</h4>

    <form action="{{ route('contributeur.traductions.store', $contenu) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Langue de traduction</label>
            <select name="langue_id" class="form-select" required>
                <option value="">Choisir une langue</option>
                @foreach($langues as $l)
                <option value="{{ $l->id }}">{{ $l->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Texte traduit</label>
            <textarea name="texte" class="form-control" rows="8" required></textarea>
        </div>

        <button class="btn btn-gold">
            <i class="bi bi-send"></i> Soumettre pour validation
        </button>
    </form>

</div>

@endsection
