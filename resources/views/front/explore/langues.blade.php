@extends('front.layouts.app')

@section('title', 'Langues béninoises')

@section('content')

<div class="container py-5">

    <h1 class="fw-bold mb-4">Langues du Bénin</h1>

    <div class="row g-4">
        @foreach($langues as $l)
        <div class="col-md-3">
            <a href="{{ route('front.langue.show', $l->code) }}" class="text-decoration-none">
                <div class="card shadow-sm p-3 text-center langue-card">
                    <h4>{{ $l->nom }}</h4>
                    <small class="text-muted">{{ $l->contenus()->count() }} contenus</small>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

<style>
.langue-card {
    border-radius: 14px;
    transition: .3s;
}
.langue-card:hover {
    background:#ffd60a;
    color:black;
    transform: translateY(-4px);
}
</style>

@endsection
