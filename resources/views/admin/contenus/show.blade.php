@extends('layouts')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Détails du contenu</h3>
    </div>

    <div class="card-body">

        {{-- IMAGE --}}
        @if($contenu->image_couverture)
            <img src="{{ asset('storage/'.$contenu->image_couverture) }}"
                 class="mb-3 rounded"
                 width="300">
        @endif

        <h2>{{ $contenu->titre }}</h2>

        <p class="text-muted">
            <strong>Type :</strong> {{ $contenu->typecontenu->nom }} <br>
            <strong>Langue :</strong> {{ $contenu->langue->nom }} <br>
            <strong>Région :</strong> {{ $contenu->region->nom ?? '—' }} <br>
            <strong>Auteur :</strong> {{ $contenu->auteur->name }} <br>
            <strong>Status :</strong>
                @if($contenu->status == 'validated')
                    <span class="badge bg-success">Validé</span>
                @elseif($contenu->status == 'pending')
                    <span class="badge bg-warning">En attente</span>
                @elseif($contenu->status == 'rejected')
                    <span class="badge bg-danger">Rejeté</span>
                @else
                    <span class="badge bg-secondary">Brouillon</span>
                @endif
            <br>

            <strong>Validé par :</strong>
            {{ $contenu->validateur->name ?? '—' }} <br>

            <strong>Créé le :</strong> {{ $contenu->created_at->format('d/m/Y H:i') }}
        </p>

        <hr>

        <h4>Description</h4>
        <p>{{ $contenu->description ?? '—' }}</p>

        <h4>Contenu texte</h4>
        <p>{!! nl2br(e($contenu->contenu_texte)) !!}</p>

        <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary mt-3">
            Retour
        </a>

    </div>
</div>

@endsection
