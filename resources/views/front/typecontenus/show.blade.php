@extends('front.layouts.app')

@section('title', $typecontenu->nom)

@section('content')

<style>
    .type-hero {
        background: linear-gradient(135deg, #1e1b4b, #2e2970);
        padding: 4rem 1rem;
        color: #fff;
        border-radius: 18px;
    }
    .type-hero-icon {
        font-size: 3rem;
        opacity: 0.9;
    }
    .type-hero-title {
        font-size: 2.4rem;
        font-weight: 700;
    }
    .contenu-card {
        border-radius: 14px;
        overflow: hidden;
        transition: .3s;
        background: #fff;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }
    .contenu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}

</style>

<div class="container py-4">

    <!-- HERO -->
    <div class="type-hero text-center mb-5">

        <i class="bi bi-folder2-open type-hero-icon"></i>

        <h1 class="type-hero-title mt-3">{{ $typecontenu->nom }}</h1>

        <p class="mt-2" style="font-size:1.1rem;">
            Découvrez les contenus appartenant à cette catégorie culturelle.
        </p>

    </div>


    <!-- CONTENUS LIÉS -->
    <h3 class="fw-bold mb-4">
        <i class="bi bi-collection"></i> Contenus associés
    </h3>

    <div class="row g-4">

        @forelse($contenus as $contenu)

            <div class="col-md-4">

                <a href="{{ route('front.contenus.show', $contenu->slug) }}" class="text-decoration-none">

                    <div class="contenu-card">

                        <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                             class="card-img-top"
                             style="height:190px; object-fit:cover;">

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $contenu->titre }}</h5>

                            <p class="text-muted small mt-2">
                                {{ Str::limit($contenu->description, 100) }}
                            </p>

                            <p class="small text-muted mt-3">
                                <i class="bi bi-translate"></i> {{ $contenu->langue->nom ?? 'Langue inconnue' }}
                                <br>
                                <i class="bi bi-geo"></i> {{ $contenu->region->nom ?? 'Région non définie' }}
                            </p>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <div class="col-12 text-center my-5">
                <p class="text-muted">Aucun contenu disponible pour ce type.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection
