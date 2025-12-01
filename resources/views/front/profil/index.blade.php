@extends('front.layouts.app')

@section('title', 'Mon Profil')

@section('content')

<div class="container py-4">

    <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-3">
            <div class="card shadow-sm p-3">

                <div class="text-center mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}&size=120"
                         class="rounded-circle shadow">
                    <h5 class="mt-3 fw-bold">{{ $user->name }}</h5>

                    <span class="badge bg-primary">
                        {{ $user->roles->pluck('name')->implode(', ') }}
                    </span>
                </div>

                <hr>

                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('front.profil') }}" class="nav-link">Tableau de bord</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('front.profil.contenus') }}" class="nav-link">Mes contenus</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('front.profil.traductions') }}" class="nav-link">Mes traductions</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('front.profil.commentaires') }}" class="nav-link">Mes commentaires</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('front.profil.edit') }}" class="nav-link">Modifier profil</a>
                    </li>
                </ul>

            </div>
        </div>

        {{-- CONTENT --}}
        <div class="col-md-9">

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="card shadow-sm p-3 text-center bg-light">
                        <h1>{{ $contenus }}</h1>
                        <p class="fw-bold">Contenus publiés</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm p-3 text-center bg-light">
                        <h1>{{ $traductions }}</h1>
                        <p class="fw-bold">Traductions</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm p-3 text-center bg-light">
                        <h1>{{ $commentaires }}</h1>
                        <p class="fw-bold">Commentaires</p>
                    </div>
                </div>

            </div>

            <hr class="my-4">

            {{-- Demande contributeur --}}
            @if(!$user->hasRole('contributeur'))
                <form action="{{ route('front.profil.demande-contributeur') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">
                        Demander à devenir contributeur
                    </button>
                </form>
            @else
                <div class="alert alert-success">
                    Vous êtes déjà contributeur 🎉
                </div>
            @endif

        </div>
    </div>

</div>

@endsection
