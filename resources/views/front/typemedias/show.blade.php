@extends('front.layouts.app')

@section('title', $type->nom)

@section('content')

<style>
    .media-hero {
        background: linear-gradient(135deg, #1e1b4b, #2e2970);
        padding: 4rem 1rem;
        color: #fff;
        border-radius: 18px;
    }

    .media-hero-icon {
        font-size: 3rem;
        opacity: .9;
    }

    .media-title {
        font-size: 2.4rem;
        font-weight: 700;
    }

    .media-card {
        border-radius: 14px;
        overflow: hidden;
        transition: .3s;
        background: #ffffff;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }

    .media-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .thumb-img {
        height: 180px;
        object-fit: cover;
    }
</style>

<div class="container py-4">

    <!-- HERO -->
    <div class="media-hero text-center mb-5">

        @if(strtolower($type->nom) == 'image')
            <i class="bi bi-image media-hero-icon"></i>
        @elseif(strtolower($type->nom) == 'video')
            <i class="bi bi-play-circle media-hero-icon"></i>
        @else
            <i class="bi bi-music-note media-hero-icon"></i>
        @endif

        <h1 class="media-title mt-3">{{ $type->nom }}</h1>

        <p class="mt-2" style="font-size:1.1rem;">
            Liste de tous les médias enregistrés dans ce format.
        </p>

    </div>


    <!-- CONTENUS LIÉS -->
    <h3 class="fw-bold mb-4">
        <i class="bi bi-collection"></i> Médias associés
    </h3>

    <div class="row g-4">

        @forelse($medias as $media)

            <div class="col-md-4">

                <div class="media-card">

                    {{-- IMAGE --}}
                    @if($type->nom === 'image')
                        <img src="{{ asset('storage/' . $media->fichier) }}"
                             class="thumb-img w-100">
                    @endif

                    {{-- VIDEO --}}
                    @if($type->nom === 'video')
                        <video class="thumb-img w-100" controls>
                            <source src="{{ asset('storage/' . $media->fichier) }}">
                        </video>
                    @endif

                    {{-- AUDIO --}}
                    @if($type->nom === 'audio')
                        <div class="p-3">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/' . $media->fichier) }}">
                            </audio>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="fw-bold">
                            {{ $media->titre ?? 'Fichier média' }}
                        </h5>

                        @if($media->contenu)
                            <p class="text-muted small">
                                <i class="bi bi-file-text"></i>
                                {{ $media->contenu->titre }}
                            </p>
                        @endif
                    </div>

                </div>

            </div>

        @empty

            <div class="col-12 text-center my-5">
                <p class="text-muted">Aucun fichier média pour ce type.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection
