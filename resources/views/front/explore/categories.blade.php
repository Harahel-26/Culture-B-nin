@extends('front.layouts.app')

@section('title', 'Catégories')

@section('content')

<div class="container py-5">

    <h1 class="fw-bold mb-4">Catégories culturelles</h1>

    <div class="row g-4">
        @foreach($categories as $cat)
        <div class="col-md-4">
            <a href="{{ route('front.categorie.show', $cat->slug) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 category-card">

                    <div class="card-body text-center p-4">
                        <h4 class="fw-bold">{{ $cat->nom }}</h4>
                        <small class="text-muted">{{ $cat->contenus()->count() }} contenus</small>
                    </div>

                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

<style>
.category-card {
    background: linear-gradient(135deg, #f4f4f4, #fafafa);
    border-radius: 16px;
    transition: .3s;
}
.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
</style>

@endsection
