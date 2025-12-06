@extends('front.layouts.app')

@section('title', 'Types de Contenus')

@section('content')

<style>
    .type-card {
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
        border: none;
        transition: .3s;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        height: 100%;
    }
    .type-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }
    .type-header {
        background: linear-gradient(135deg, #1e1b4b, #2e2970);
        color: #ffffff;
        padding: 25px;
        text-align: center;
    }
    .type-header-icon {
        font-size: 2.5rem;
        opacity: .9;
    }
    .type-title {
        margin-top: 10px;
        font-size: 1.3rem;
        font-weight: 700;
    }
    .type-body {
        padding: 20px 25px;
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}

</style>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Types de Contenus</h1>
        <p class="text-muted mt-2" style="font-size:1.05rem;">
            Explorez les catégories culturelles du Bénin.
        </p>
    </div>

    <div class="row g-4">

        @foreach($types as $type)

            <div class="col-md-4">

                <a href="{{ route('front.typecontenus.show', $type->slug) }}" class="text-decoration-none">

                    <div class="type-card">

                        <div class="type-header">
                            <i class="bi bi-folder2-open type-header-icon"></i>
                            <div class="type-title">{{ $type->nom }}</div>
                        </div>

                        <div class="type-body">
                            <span class="badge bg-primary">
                                {{ $type->contenus->count() }} contenus
                            </span>
                        </div>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

</div>

@endsection
