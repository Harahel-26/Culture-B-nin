@extends('front.layouts.app')

@section('title', 'Mes favoris')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5">
        <h1 class="fw-bold text-white">Mes favoris</h1>
        <p class="text-light">Vos contenus enregistrés pour plus tard ❤️</p>
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
        position: relative;
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

    .favori-btn {
        position:absolute;
        top:12px;
        right:12px;
        z-index: 3;
    }
</style>

<div class="container">

    @if($favoris->isEmpty())
        <div class="text-center py-5">
            <h4 class="fw-bold text-muted mb-3">Aucun favori pour le moment</h4>
            <a href="{{ route('front.contenus.index') }}" class="btn btn-gold">
                Explorer les contenus
            </a>
        </div>
    @else

        <div class="row g-4">
            @foreach($favoris as $c)
            <div class="col-md-4">

                <div class="contenu-card">

                    {{-- BOUTON POUR RETIRER DES FAVORIS --}}
                    <form action="{{ route('front.favoris.toggle') }}" 
                          method="POST" 
                          class="favori-btn">
                        @csrf
                        <input type="hidden" name="contenu_id" value="{{ $c->id }}">

                        <button type="submit" class="btn btn-light btn-sm rounded-circle shadow">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </form>

                    {{-- IMAGE --}}
                    <a href="{{ route('front.contenus.show', $c->slug) }}" class="text-decoration-none text-dark">
                        <img src="{{ $c->image_couverture ? asset('storage/'.$c->image_couverture) : asset('images/default-cover.jpg') }}"
                             class="contenu-cover">
                        
                        <div class="p-3">
                            <h5 class="fw-bold">{{ $c->titre }}</h5>

                            <small class="text-muted">
                                {{ $c->typecontenu->nom }} • {{ $c->langue->nom }}
                            </small>
                        </div>
                    </a>

                </div>

            </div>
            @endforeach
        </div>

    @endif

</div>

@endsection
