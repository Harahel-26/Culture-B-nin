@extends('front.layouts.app')

@section('title', 'Langue : ' . $langue->nom)

@section('content')

<div class="container py-5">

    <h1 class="fw-bold mb-2">Contenus en {{ $langue->nom }}</h1>
    <p class="text-muted mb-4">{{ $contenus->total() }} contenus disponibles dans cette langue.</p>

    <div class="row g-4">
        @forelse($contenus as $c)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">

                {{-- Affichage de l'image par défaut (Correction de la référence) --}}
                <img src="{{ asset('images/default-content.jpg') }}"
                     class="card-img-top"
                     alt="Image de {{ $c->titre }}"
                     style="height:180px; object-fit:cover;">

                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">{{ $c->titre }}</h5>
                    <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit($c->resume, 120) }}</p>

                    <a href="{{ route('front.contenus.show', $c->slug) }}" class="btn btn-outline-success mt-auto">
                        Lire ce contenu →
                    </a>
                </div>
            </div>
        </div>
        @empty
            <div class="alert alert-info" role="alert">
                Aucun contenu n'a encore été publié en langue {{ $langue->nom }}.
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $contenus->links() }}
    </div>

</div>

@endsection
