@extends('front.layouts.app')

@section('title', 'Régions du Bénin')

@section('content')

<style>
    .region-card {
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
        border: none;
        transition: .3s;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }
    .region-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }
    .region-header {
        background: linear-gradient(135deg, #1e1b4b, #2e2970);
        padding: 30px;
        color: #ffffff;
        text-align: center;
    }
    .region-title {
        font-size: 1.3rem;
        font-weight: 700;
    }
    .region-body {
        padding: 20px 25px;
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}

    .region-type {
        color: #1e1b4b;
        font-weight: 600;
        font-size: .95rem;
    }
</style>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Régions du Bénin</h1>
        <p class="text-muted mt-2" style="font-size:1.05rem;">
            Liste des régions administratives, culturelles et linguistiques du Bénin.
        </p>
    </div>

    <div class="row g-4">

        @foreach($regions as $region)

            <div class="col-md-4">

                <a href="{{ route('front.regions.show', $region->slug) }}" class="text-decoration-none">

                    <div class="region-card">

                        <div class="region-header">
                            <i class="bi bi-geo-alt" style="font-size:2rem;"></i>
                            <div class="region-title mt-2">{{ $region->nom }}</div>
                        </div>

                        <div class="region-body">
                            <div class="region-type mb-1">
                                <i class="bi bi-tag"></i> {{ $region->type ?? 'Type non défini' }}
                            </div>

                            <div class="text-muted small">
                                {{ Str::limit($region->description, 120) }}
                            </div>

                            <div class="mt-3">
                                @if($region->languePrincipale)
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-translate"></i>
                                        {{ $region->languePrincipale->nom }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Aucune langue définie</span>
                                @endif
                            </div>
                        </div>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

</div>

@endsection
