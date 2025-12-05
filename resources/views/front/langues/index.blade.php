@extends('front.layouts.app')

@section('title', 'Langues du Bénin')

@section('content')

<style>
    .lang-card {
        transition: 0.3s;
        border-radius: 14px;
        overflow: hidden;
        border: none;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .lang-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }
    .lang-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #eee;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .lang-title {
        font-weight: 700;
        font-size: 1.3rem;
        color: #1d1d1d;
    }
    .lang-desc {
        font-size: 0.92rem;
        color: #555;
    }
</style>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold" style="font-size:2.2rem;">
             Les langues du Bénin
        </h1>
        <p class="text-muted mt-2" style="font-size:1.05rem;">
            Découvrez la richesse linguistique du Bénin à travers ses langues locales et nationales.
        </p>
    </div>

    <div class="row g-4">

        @foreach($langues as $langue)

            <div class="col-md-4">
                <a href="{{ route('front.langues.show', $langue->code) }}" class="text-decoration-none">

                    <div class="card lang-card p-4 text-center">

                        <img src="{{ $langue->icone_url }}"
                             class="lang-img mb-3"
                             alt="{{ $langue->nom }}">

                        <div class="lang-title">{{ $langue->nom }}</div>

                        <p class="lang-desc mt-2">
                            {{ Str::limit($langue->description, 100) }}
                        </p>

                        <div class="mt-3">
                            <span class="badge bg-primary px-3 py-2">
                                Code : {{ $langue->code }}
                            </span>
                        </div>

                    </div>

                </a>
            </div>

        @endforeach

    </div>
</div>

@endsection
