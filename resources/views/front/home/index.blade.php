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
        height: 100%;
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

    /* Style pour le diaporama */
    .diaporama-section {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin: 2rem auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .swiper-slide {
        height: auto;
    }

    .diaporama-slide {
        border-radius: 15px;
        overflow: hidden;
        height: 300px;
        position: relative;
    }

    .diaporama-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slide-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 1.5rem;
    }

    .swiper-pagination-bullet {
        background: #d4a017 !important;
    }

    .swiper-pagination-bullet-active {
        background: #a16207 !important;
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
                    @if($c->favoris && $c->favoris->contains('user_id', auth()->id() ?? null))
                    <button class="btn favori-btn position-absolute">
                        <i class="bi bi-heart-fill text-danger"></i>
                    </button>
                    @else
                    <form action="{{ route('front.favoris.toggle', $c) }}" method="POST" class="position-absolute favori-btn">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm">
                            <i class="bi bi-heart"></i>
                        </button>
                    </form>
                    @endif

                    <img src="{{ $c->image_couverture ? asset('storage/'.$c->image_couverture) : asset('images/default-cover.jpg') }}"
                         class="contenu-cover"
                         alt="{{ $c->titre }}">

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

{{-- SECTION : GALERIE DES MÉDIAS --}}
<section class="mb-5">
    <h2 class="home-section-title">
        <i class="bi bi-camera-reels"></i> Galerie des médias
    </h2>

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <p class="mb-0 text-muted" style="max-width:550px;">
            Explorez les vidéos, images et sons liés aux contenus culturels :
            cérémonies, danses, art vodun, paysages et scènes de vie quotidienne.
        </p>

        <a href="{{ route('front.medias.index') }}" class="btn btn-gold btn-lg">
            <i class="bi bi-collection-play me-2"></i>
            Accéder à la galerie
        </a>
    </div>
</section>


{{-- CARROUSEL PREMIUM --}}
<section class="mb-5">
    <h2 class="home-section-title">
        <i class="bi bi-star-fill text-warning"></i> Contenus Premium populaires
    </h2>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($premium as $c)
            <div class="swiper-slide">
                <a href="{{ route('front.contenus.show', $c->slug) }}"
                   class="text-decoration-none text-dark">
                    <div class="contenu-card position-relative" style="height:100%;">
                        @if($c->favoris && $c->favoris->contains('user_id', auth()->id() ?? null))
                        <button class="btn favori-btn position-absolute">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                        @else
                        <form action="{{ route('front.favoris.toggle', $c) }}" method="POST" class="position-absolute favori-btn">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">
                                <i class="bi bi-heart"></i>
                            </button>
                        </form>
                        @endif

                        <img src="{{ asset('storage/'.$c->image_couverture) }}"
                             class="contenu-cover"
                             alt="{{ $c->titre }}">

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
        <div class="swiper-pagination"></div>
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
                    @if($c->favoris && $c->favoris->contains('user_id', auth()->id() ?? null))
                    <button class="btn favori-btn position-absolute">
                        <i class="bi bi-heart-fill text-danger"></i>
                    </button>
                    @else
                    <form action="{{ route('front.favoris.toggle', $c) }}" method="POST" class="position-absolute favori-btn">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm">
                            <i class="bi bi-heart"></i>
                        </button>
                    </form>
                    @endif

                    <img src="{{ asset('storage/'.$c->image_couverture) }}"
                         class="contenu-cover"
                         alt="{{ $c->titre }}">

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

<script>
    // Initialiser le diaporama
    var diaporamaSwiper = new Swiper(".diaporamaSwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
        },
    });

    // Initialiser le carrousel premium (existant)
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1.2,
        spaceBetween: 10,
        centeredSlides: false,
        grabCursor: true,
        breakpoints: {
            540: { slidesPerView: 2.2 },
            768: { slidesPerView: 3 },
            1200: { slidesPerView: 4 },
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    // Animation au défilement
    ScrollReveal().reveal('.home-section-title', {
        delay: 100,
        distance: '20px',
        origin: 'bottom',
        opacity: 0,
        duration: 800
    });

    ScrollReveal().reveal('.contenu-card', {
        delay: 200,
        distance: '30px',
        origin: 'bottom',
        opacity: 0,
        interval: 100,
        duration: 900
    });
</script>

@endsection
