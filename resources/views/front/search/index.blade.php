@extends('front.layouts.app')

@section('title', 'Recherche')

@section('content')

<h2 class="fw-bold mb-4">Résultats pour : "{{ $query }}"</h2>

{{-- FILTRES --}}
<form method="GET" class="row g-3 mb-4">
    <input type="hidden" name="q" value="{{ $query }}">

    <div class="col-md-3">
        <select name="categorie" class="form-select">
            <option value="">Toutes catégories</option>
            @foreach($types as $t)
                <option value="{{ $t->id }}">{{ $t->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="langue" class="form-select">
            <option value="">Toutes langues</option>
            @foreach($langues as $l)
                <option value="{{ $l->id }}">{{ $l->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="region" class="form-select">
            <option value="">Toutes régions</option>
            @foreach($regions as $r)
                <option value="{{ $r->id }}">{{ $r->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-dark w-100">
            Filtrer
        </button>
    </div>
</form>

<hr>

{{-- CONTENUS --}}
<h4 class="mt-4 mb-3">📄 Contenus</h4>

@if($contenus->count() == 0)
    <p>Aucun contenu trouvé.</p>
@endif

<div class="row">
    @foreach($contenus as $c)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">{{ $c->titre }}</h5>
                <p>{{ Str::limit($c->resume, 150) }}</p>
                <a href="{{ route('front.contenus.show', $c->slug) }}" class="btn btn-outline-primary btn-sm">Voir plus</a>
            </div>
        </div>
    @endforeach
</div>

{{ $contenus->links() }}

<hr class="my-5">

{{-- MÉDIAS --}}
<h4 class="mt-4 mb-3">🎬 Médias</h4>

@if($medias->count() == 0)
    <p>Aucun média trouvé.</p>
@endif

<div class="row g-3">
    @foreach($medias as $m)
        <div class="col-6 col-md-3">
            <div class="card shadow-sm">
                @if($m->type_media_id == 1)
                    <img src="{{ asset('storage/'.$m->fichier) }}" class="w-100 rounded">
                @elseif($m->type_media_id == 2)
                    <video src="{{ asset('storage/'.$m->fichier) }}" class="w-100 rounded" controls></video>
                @else
                    <audio class="w-100" controls>
                        <source src="{{ asset('storage/'.$m->fichier) }}">
                    </audio>
                @endif
            </div>
        </div>
    @endforeach
</div>

{{ $medias->links() }}

@endsection
