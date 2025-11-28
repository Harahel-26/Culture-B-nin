@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Détails de la traduction</h3>
    </div>

    <div class="card-body">

        {{-- Informations générales --}}
        <h4 class="mb-3">{{ $traduction->titre ?? '— (titre traduit indisponible)' }}</h4>

        <p class="text-muted">
            <strong>Contenu original :</strong>
                {{ $traduction->contenu->titre }} <br>

            <strong>Langue cible :</strong>
                {{ $traduction->langue->nom }} <br>

            <strong>Traduit par :</strong>
                {{ $traduction->traducteur->name }} <br>

            <strong>Status :</strong>
                @if($traduction->status == 'pending')
                    <span class="badge bg-warning">En attente</span>
                @elseif($traduction->status == 'validated')
                    <span class="badge bg-success">Validée</span>
                @else
                    <span class="badge bg-danger">Rejetée</span>
                @endif
            <br>

            <strong>Validé par :</strong>
                {{ $traduction->validateur->name ?? '—' }} <br>

            <strong>Date :</strong>
                {{ $traduction->created_at->format('d/m/Y H:i') }}
        </p>

        <hr>

        {{-- Description traduite --}}
        <h5>Description traduite :</h5>
        <p>{{ $traduction->description ?? '—' }}</p>

        <hr>

        {{-- Contenu texte traduit --}}
        <h5>Texte traduit :</h5>
        <p>{!! nl2br(e($traduction->contenu_texte)) !!}</p>

        <div class="mt-3">

            {{-- Bouton retour --}}
            <a href="{{ route('traductions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>

            {{-- Bouton modifier (uniquement si c’est le traducteur) --}}
            @if($traduction->traduit_par == auth()->id())
                <a href="{{ route('traductions.edit', $traduction) }}"
                   class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
            @endif

            {{-- Bouton valider (admin/modérateur seulement) --}}
            @if(auth()->user()->hasRole(['admin','moderateur']) && $traduction->status != 'validated')
                <form action="{{ route('traductions.valider', $traduction) }}"
                      method="POST" class="d-inline">
                    @csrf @method('PUT')
                    <button class="btn btn-success">
                        <i class="fas fa-check"></i>
                    </button>
                </form>
            @endif

            {{-- Bouton rejeter --}}
            @if(auth()->user()->hasRole(['admin','moderateur']) && $traduction->status != 'rejected')
                <form action="{{ route('traductions.rejeter', $traduction) }}"
                      method="POST" class="d-inline">
                    @csrf @method('PUT')
                    <button class="btn btn-danger">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
            @endif

        </div>

    </div>

</div>

@endsection
