@extends('front.layouts.app')

@section('title', 'Contenus Culturels du Bénin')

@section('content')

<h2 class="fw-bold mb-4">Tous les contenus</h2>

<div class="row g-4">

@foreach($contenus as $c)
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/default-content.jpg') }}"
                 class="card-img-top" style="height:170px; object-fit:cover;">

            <div class="card-body">
                <h5 class="fw-bold">{{ $c->titre }}</h5>
                <p class="text-muted small">
                    {{ Str::limit($c->description, 120) }}
                </p>

                <a href="{{ route('front.contenus.show', $c->slug) }}" class="btn btn-success btn-sm">
                    Lire plus →
                </a>
            </div>

            <div class="card-footer text-muted small">
                Publié le {{ $c->created_at->format('d/m/Y') }}
            </div>
        </div>
    </div>
@endforeach

@if($contenus->isEmpty())
    <p class="text-muted">Aucun contenu disponible pour le moment.</p>
@endif

</div>

<div class="mt-4">
    {{ $contenus->links() }}
</div>

@endsection
