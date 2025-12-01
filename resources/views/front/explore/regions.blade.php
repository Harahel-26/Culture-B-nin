@extends('front.layouts.app')

@section('title', 'Régions du Bénin')

@section('content')

<div class="container py-5">

    <h1 class="fw-bold mb-4">Régions du Bénin</h1>

    <div class="row g-4">
        @foreach($regions as $reg)
        <div class="col-md-3">
            <a href="{{ route('front.region.show', $reg->slug) }}" class="text-decoration-none">
                <div class="card shadow-sm region-card p-3 text-center">
                    <h4>{{ $reg->nom }}</h4>
                    <small class="text-muted">{{ $reg->contenus()->count() }} contenus</small>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

<style>
.region-card {
    border-radius: 12px;
    transition: .3s;
}
.region-card:hover {
    background: #0055aa;
    color: white;
    transform: translateY(-4px);
}
</style>

@endsection
