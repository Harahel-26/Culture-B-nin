@extends('front.layouts.app')

@section('title', 'Types de Médias')

@section('content')

<style>
    .type-card {
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
        transition: .3s;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }
    .type-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}


    .type-header {
        background: linear-gradient(135deg, #1e1b4b, #2e2970);
        padding: 28px;
        color: #ffffff;
        text-align: center;
    }

    .type-icon {
        font-size: 2.7rem;
        opacity: .9;
    }

    .type-title {
        margin-top: 12px;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .type-body {
        padding: 20px 25px;
    }
</style>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Types de Médias</h1>
        <p class="text-muted" style="font-size:1.1rem;">
            Explorez les contenus culturels selon leur format : images, vidéos, audios.
        </p>
    </div>

    <div class="row g-4">

        @foreach($types as $type)

            <div class="col-md-4">

                <a href="{{ route('front.typemedia.show', $type->slug) }}" class="text-decoration-none">

                    <div class="type-card">

                        <div class="type-header">

                            @if(strtolower($type->nom) == 'image')
                                <i class="bi bi-image type-icon"></i>
                            @elseif(strtolower($type->nom) == 'video')
                                <i class="bi bi-play-circle type-icon"></i>
                            @else
                                <i class="bi bi-music-note type-icon"></i>
                            @endif

                            <div class="type-title">{{ $type->nom }}</div>
                        </div>

                        <div class="type-body">
                            <span class="badge bg-primary">
                                {{ $type->medias->count() }} fichiers
                            </span>
                        </div>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

</div>

@endsection
