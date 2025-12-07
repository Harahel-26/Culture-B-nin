@extends('front.layouts.app')

@section('title', 'Proposer une traduction')

@section('content')

<div class="container py-4">

    <h2 class="fw-bold mb-4">
        <i class="bi bi-translate"></i> Proposer une traduction
        <small class="text-muted">({{ $contenu->titre }})</small>
    </h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('contributeur.traductions.store', $contenu->id) }}"
                  method="POST">
                @csrf

                {{-- Sélection langue --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Langue de la traduction</label>
                    <select class="form-select" name="langue_id" required>
                        <option value="">Sélectionner...</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue->id }}">{{ $langue->nom }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Zone de texte --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Texte traduit</label>
                    <textarea class="form-control" name="texte" rows="8" required></textarea>
                </div>

                <button class="btn btn-gold">
                    <i class="bi bi-send"></i> Envoyer pour validation
                </button>
            </form>

        </div>
    </div>

</div>

@endsection
