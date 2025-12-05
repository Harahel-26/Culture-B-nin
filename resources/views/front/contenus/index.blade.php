@extends('front.layouts.app')

@section('title', 'Tous les contenus')

@section('content')

<style>
    .card-contenu {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0,0,0,0.1);
        transition: .3s;
    }
    .card-contenu:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.15);
    }
    .cover {
        width: 100%;
        height: 170px;
        object-fit: cover;
    }
    .badge-premium {
        background: #d4a017;
        color: #fff;
        padding: 5px 8px;
        border-radius: 6px;
        font-size: .75rem;
    }
</style>

<div class="container py-5">

    <h1 class="fw-bold mb-4">
        Contenus disponibles
    </h1>

    <div class="row g-4">

        @foreach($contenus as $contenu)
        <div class="col-md-4">

            <a href="{{ route('front.contenus.show', $contenu->slug) }}" class="text-decoration-none text-dark">

                <div class="card-contenu">

                    <img src="{{ $contenu->image_couverture
                        ? asset('storage/'.$contenu->image_couverture)
                        : asset('images/default-cover.jpg') }}"
                        class="cover">

                    <div class="p-3">

                        <h5 class="fw-bold">{{ $contenu->titre }}</h5>

                        <small class="text-muted">
                            {{ $contenu->typecontenu->nom }} —
                            {{ $contenu->langue->nom }}
                        </small>
                        <br>

                        @if($contenu->is_premium)
                            <span class="badge-premium mt-2">Premium</span>
                        @else
                            <span class="text-success mt-2">Gratuit</span>
                        @endif

                        <hr>

                        <p class="small text-muted">
                            {{ $contenu->extrait }}
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
