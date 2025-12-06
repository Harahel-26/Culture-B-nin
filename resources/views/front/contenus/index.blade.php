@extends('front.layouts.app')

@section('title', 'Tous les contenus')

{{-- HERO HEADER PERSONNALISÉ --}}
@section('hero')
<section class="page-header-hero">
    <div class="container text-center">
        <h1 class="fw-bold mb-2">Explorer nos contenus</h1>
        <p class="text-light fs-6">
            Découvrez les langues, traditions, récits, régions et histoires du Bénin.
        </p>
    </div>
</section>
@endsection

@section('content')

<style>
    .contenu-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: .3s ease-in-out;
        cursor: pointer;
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}

    .contenu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.12);
    }
    .contenu-cover {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .badge-premium {
        background: #d4a017;
        color: #fff;
        padding: 4px 8px;
        border-radius: 5px;
        font-size: .75rem;
    }
    .filter-box {
        background:#fff;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        margin-bottom: 25px;
    }
</style>

<div class="container">

    {{-- FILTRES --}}
    <div class="filter-box mb-4">
        <form method="GET">

            <div class="row g-3">

                {{-- FILTRE LANGUE --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Langue</label>
                    <select name="langue" class="form-select">
                        <option value="">Toutes</option>
                        @foreach($langues as $l)
                            <option value="{{ $l->id }}"
                                @selected(request('langue') == $l->id)>
                                {{ $l->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FILTRE TYPE --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select">
                        <option value="">Tous</option>
                        @foreach($typecontenus as $t)
                            <option value="{{ $t->id }}"
                                @selected(request('type') == $t->id)>
                                {{ $t->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FILTRE REGION --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Région</label>
                    <select name="region" class="form-select">
                        <option value="">Toutes</option>
                        @foreach($regions as $r)
                            <option value="{{ $r->id }}"
                                @selected(request('region') == $r->id)>
                                {{ $r->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BOUTON FILTRER --}}
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-gold w-100">
                        <i class="bi bi-funnel"></i> Filtrer
                    </button>
                </div>

            </div>

        </form>
    </div>


    {{-- LISTE DES CONTENUS --}}
    <div class="row g-4">

        @foreach($contenus as $c)
        <div class="col-md-4">

            <a href="{{ route('front.contenus.show', $c->slug) }}"
               class="text-decoration-none text-dark">

                <div class="contenu-card">
                    <x-favori-button :contenu="$c" />

                    <img src="{{ $c->image_couverture ? asset('storage/'.$c->image_couverture) : asset('images/default-cover.jpg') }}"
                         class="contenu-cover">

                    <div class="p-3">

                        <h5 class="fw-bold">{{ $c->titre }}</h5>

                        <small class="text-muted">
                            {{ $c->typecontenu->nom }} • {{ $c->langue->nom }}
                        </small>

                        <div class="mt-2">
                            @if($c->is_premium)
                                <span class="badge-premium">Premium</span>
                            @else
                                <span class="text-success fw-semibold">Gratuit</span>
                            @endif
                        </div>

                        <p class="mt-3 small text-muted">
                            {{ $c->extrait }}
                        </p>

                    </div>

                </div>

            </a>

        </div>
        @endforeach

    </div>

    <div class="mt-4">
        {{ $contenus->links() }}
    </div>

</div>

@endsection
