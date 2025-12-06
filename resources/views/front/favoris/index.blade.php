@extends('front.layouts.app')

@section('title', 'Mes favoris')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5">
        <h1 class="fw-bold text-white">Mes favoris</h1>
        <p class="text-light">
            Vos contenus sauvegardés pour plus tard ❤️
        </p>
    </div>
</section>
@endsection

@section('content')

<style>
    .contenu-card {
        border-radius:14px;
        overflow:hidden;
        background:#fff;
        box-shadow:0 4px 12px rgba(0,0,0,0.08);
        transition:.3s;
    }
    .contenu-card:hover {
        transform:translateY(-5px);
        box-shadow:0 8px 20px rgba(0,0,0,0.12);
    }
    .contenu-cover {
        height:170px;
        width:100%;
        object-fit:cover;
    }
</style>

<div class="container">

    @if($favoris->isEmpty())
        <div class="text-center py-5">
            <h4 class="fw-bold text-muted mb-3">Aucun favori pour le moment</h4>
            <a href="{{ route('front.contenus.index') }}"
               class="btn btn-gold">
                Explorer les contenus
            </a>
        </div>
    @else

        <div class="row g-4">
            @foreach($favoris as $c)
            <div class="col-md-4">
                <a href="{{ route('front.contenus.show', $c->slug) }}"
                   class="text-decoration-none text-dark">

                    <div class="contenu-card">

                        <img src="{{ asset('storage/'.$c->image_couverture) }}"
                             class="contenu-cover">

                        <div class="p-3">

                            <h5 class="fw-bold">{{ $c->titre }}</h5>
                            <small class="text-muted">
                                {{ $c->typecontenu->nom }} • {{ $c->langue->nom }}
                            </small>

                            <div class="mt-2">
                                <i class="bi bi-heart-fill text-danger fs-4"></i>
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
