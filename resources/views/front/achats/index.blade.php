@extends('front.layouts.app')

@section('title', 'Mes achats')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5">
        <h1 class="fw-bold text-white">Mes achats</h1>
        <p class="text-light">Vos contenus premium achetés</p>
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
        background:#d4a017;
        color:#fff;
        padding:4px 8px;
        border-radius:6px;
        font-size:.75rem;
    }
</style>

<div class="container">

    @if($achats->count() === 0)
        <div class="text-center py-5">
            <h4 class="fw-bold text-muted">Aucun achat pour le moment.</h4>
            <a href="{{ route('front.contenus.index') }}" class="btn btn-gold mt-3">
                Explorer les contenus
            </a>
        </div>
    @else

        <div class="row g-4">

            @foreach($achats as $c)
            <div class="col-md-4">
                <a href="{{ route('front.contenus.show',$c->slug) }}"
                   class="text-decoration-none text-dark">

                    <div class="contenu-card">
                        <x-favori-button :contenu="$c" />

                        <img src="{{ asset('storage/'.$c->image_couverture) }}"
                             class="contenu-cover">

                        <div class="p-3">

                            <h5 class="fw-bold">{{ $c->titre }}</h5>

                            <small class="text-muted">
                                {{ $c->typecontenu->nom }} • {{ $c->langue->nom }}
                            </small>

                            <div class="mt-2">
                                <span class="badge-premium">Premium</span>
                            </div>

                        </div>

                    </div>

                </a>
            </div>
            @endforeach

        </div>

    @endif

</div>

@endsection
