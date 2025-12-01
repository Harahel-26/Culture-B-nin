@extends('front.layouts.app')

@section('title', $categorie->nom)

@section('content')

<div class="container py-5">

    <h1 class="fw-bold mb-2">{{ $categorie->nom }}</h1>
    <p class="text-muted mb-4">{{ $contenus->total() }} contenus disponibles</p>

    <div class="row g-4">
        @foreach($contenus as $c)
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <img src="{{ asset('images/default-content.jpg') }}" class="card-img-top" style="height:180px; object-fit:cover;">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $c->titre }}</h5>
                    <p>{{ Str::limit($c->resume, 120) }}</p>

                    <a href="{{ route('front.contenus.show', $c->slug) }}" class="btn btn-outline-primary">
                        Lire
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $contenus->links() }}
    </div>

</div>

@endsection
