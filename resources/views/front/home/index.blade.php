@extends('front.layouts.app')

@section('title', 'Accueil - Culture Bénin')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container">

        <h1 class="fw-bold mb-3" style="font-size:2.6rem;">
            Découvrez la richesse culturelle du Bénin
        </h1>

        <p class="text-light fs-5 mb-4">
            Traditions, arts, langues, récits, patrimoines…
            Une bibliothèque numérique 100% Bénin.
        </p>

        <a href="{{ route('front.contenus.index') }}" class="btn btn-gold btn-lg px-4">
            Explorer les contenus
            <i class="bi bi-arrow-right ms-1"></i>
        </a>

    </div>
</section>
@endsection

@section('content')

<style>
    .home-section-title {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.6rem;
        margin-bottom: 20px;
    }

    .contenu-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all .3s;
    }
    .contenu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 22px rgba(0,0,0,0.15);
    }

    .contenu-cover {
        width: 100%;
        height: 170px;
        object-fit: cover;
    }

    .badge-premium {
        background: #d4a017;
        color: #fff;
        padding: 4px 8px;
        border-radius: 5px;
        font-size: .75rem;
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}

</style>


{{-- SECTION 1 : CONTENUS RÉCENTS --}}
<section class="mb-5">
    <h2 class="home-section-title">
        <i class="bi bi-clock-history"></i> Derniers contenus publiés
    </h2>

    <div class="row g-4">

        @foreach($recents as $c)
        <div class="col-md-4">
            <a href="{{ route('front.contenus.show', $c->slug) }}" class="text-decoration-none text-dark">

                <div class="contenu-card">
                    <x-favori-button :contenu="$c" />
                    <img src="{{ $c->image_couverture ? asset('storage/'.$c->image_couverture) : asset('images/default-cover.jpg') }}"
                         class="contenu-cover">

                    <div class="p-3">
                        <h5 class="fw-bold">{{ $c->titre }}</h5>
                        <small class="text-muted">
                            {{ $c->typecontenu->nom }} • {{ $c->langue->nom }}
                        </small>

                        @if($c->is_premium)
                            <div class="mt-2">
                                <span class="badge-premium">Premium</span>
                            </div>
                        @endif
                    </div>
                </div>

            </a>
        </div>
        @endforeach

    </div>
</section>


{{-- SECTION 2 : PREMIUM POPULAIRES --}}
<section class="mb-5">
    <h2 class="home-section-title">
        <i class="bi bi-star-fill text-warning"></i> Contenus premium populaires
    </h2>

    <div class="row g-4">

        @forelse($premium as $c)
        <div class="col-md-4">
            <a href="{{ route('front.contenus.show', $c->slug) }}" class="text-decoration-none text-dark">

                <div class="contenu-card">
                    <img src="{{ asset('storage/'.$c->image_couverture) }}"
                         class="contenu-cover">

                    <div class="p-3">
                        <h5 class="fw-bold">{{ $c->titre }}</h5>
                        <small class="text-muted">
                            {{ $c->prix_formatte }}
                        </small>
                        <div class="mt-2">
                            <span class="badge-premium">Premium</span>
                        </div>
                    </div>
                </div>

            </a>
        </div>
        @empty
            <p>Aucun contenu premium disponible pour le moment.</p>
        @endforelse

    </div>
</section>


{{-- SECTION 3 : GRATUITS --}}
<section class="mb-5">
    <h2 class="home-section-title">
        <i class="bi bi-unlock"></i> Contenus gratuits
    </h2>

    <div class="row g-4">

        @foreach($gratuits as $c)
        <div class="col-md-4">
            <a href="{{ route('front.contenus.show', $c->slug) }}" class="text-decoration-none text-dark">

                <div class="contenu-card">
                    <img src="{{ asset('storage/'.$c->image_couverture) }}"
                         class="contenu-cover">

                    <div class="p-3">
                        <h5 class="fw-bold">{{ $c->titre }}</h5>
                        <small class="text-muted">
                            {{ $c->typecontenu->nom }} • {{ $c->langue->nom }}
                        </small>
                    </div>
                </div>

            </a>
        </div>
        @endforeach

    </div>
</section>

@endsection
