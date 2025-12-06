@extends('front.layouts.app')

@section('title', $region->nom)

@section('content')

<style>
    .region-hero {
        background: linear-gradient(135deg, #1e1b4b, #2e2970);
        padding: 4rem 1rem;
        color: #fff;
        border-radius: 18px;
    }
    .region-hero-icon {
        font-size: 3.5rem;
        opacity: 0.85;
    }
    .region-title {
        font-size: 2.4rem;
        font-weight: 700;
    }
    .info-block {
        font-size: 1.1rem;
    }
    .contenu-card {
        border-radius: 14px;
        overflow: hidden;
        transition: .3s;
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

    <!-- HERO SECTION -->
    <div class="region-hero text-center mb-5">

        <i class="bi bi-geo-alt region-hero-icon"></i>

        <h1 class="region-title mt-3">{{ $region->nom }}</h1>

        <p class="mt-3 info-block">
            {{ $region->description ?? 'Aucune description disponible.' }}
        </p>

        <div class="mt-4">
            @if($region->type)
                <span class="badge bg-light text-dark mx-1">
                    <i class="bi bi-tag"></i> {{ $region->type }}
                </span>
            @endif

            @if($region->languePrincipale)
                <span class="badge bg-warning text-dark mx-1">
                    <i class="bi bi-translate"></i> {{ $region->languePrincipale->nom }}
                </span>
            @endif
        </div>

    </div>


    <!-- CONTENUS LIÉS À LA RÉGION -->
    <h3 class="fw-bold mb-4">
        <i class="bi bi-collection"></i> Contenus liés à cette région
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
                        </div>

                    </div>

                </a>

            </div>

        @empty

            <div class="col-12 text-center my-5">
                <p class="text-muted">Aucun contenu associé pour le moment.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection
