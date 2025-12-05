@extends('front.layouts.app')

@section('title', $langue->nom)

@section('content')

<style>
    .hero-lang {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        padding: 4rem 1rem;
        color: white;
        border-radius: 16px;
    }
    .hero-lang img {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 5px solid rgba(255,255,255,0.4);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }
    .contenu-card {
        border-radius: 14px;
        overflow: hidden;
        transition: 0.35s;
        box-shadow: 0 6px 25px rgba(0,0,0,0.08);
    }
    .contenu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }
    .contenu-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a1a;
    }
</style>

<div class="container py-4">

    <!-- HERO -->
    <div class="hero-lang text-center mb-5">

        <img src="{{ $langue->icone_url }}" class="mb-3">

        <h1 class="fw-bold mt-3" style="font-size:2.4rem;">
            {{ $langue->nom }}
        </h1>

        <p class="mt-3" style="font-size:1.1rem;">
            {{ $langue->description }}
        </p>

    </div>

    <h3 class="fw-bold mb-4">
         Contenus en {{ $langue->nom }}
    </h3>

    <div class="row g-4">

        @forelse($contenus as $contenu)

            <div class="col-md-4">

                <a href="{{ route('front.contenus.show', $contenu->slug) }}" class="text-decoration-none">

                    <div class="card contenu-card">

                        <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                             class="card-img-top"
                             style="height:190px; object-fit:cover;">

                        <div class="card-body">

                            <div class="contenu-title">
                                {{ $contenu->titre }}
                            </div>

                            <p class="text-muted small mt-2">
                                {{ Str::limit($contenu->description, 100) }}
                            </p>

                        </div>
                    </div>

                </a>

            </div>

        @empty

            <div class="col-12 text-center my-5">
                <p class="text-muted" style="font-size:1.2rem;">
                    Aucun contenu n’est encore disponible dans cette langue.
                </p>
            </div>

        @endforelse

    </div>

</div>

@endsection
