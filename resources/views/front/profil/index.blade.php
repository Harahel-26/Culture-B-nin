@extends('front.layouts.app')

@section('title', 'Mon profil')

@section('content')

<div class="container py-4">

    <h2 class="fw-bold mb-4"><i class="bi bi-person-circle"></i> Mon profil</h2>

    <div class="row">

        {{-- CARTE INFO --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center">

                    {{-- Avatar --}}
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}"
                         class="rounded-circle mb-3"
                         style="width:120px; height:120px; object-fit:cover;">

                    <h4 class="fw-bold">{{ auth()->user()->name }}</h4>
                    <p class="text-muted">{{ auth()->user()->email }}</p>

                    {{-- Bouton modifier --}}
                    <a href="{{ route('front.profil.edit') }}" class="btn btn-gold w-100 mt-3">
                        <i class="bi bi-pencil"></i> Modifier le profil
                    </a>
                </div>
            </div>
        </div>

        {{-- LISTE DES OPTIONS --}}
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3"><i class="bi bi-gear"></i> Paramètres du compte</h5>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <strong>Téléphone :</strong> {{ auth()->user()->phone ?? 'Non renseigné' }}
                        </li>

                        <li class="list-group-item">
                            <strong>Adresse :</strong> {{ auth()->user()->adresse ?? 'Non renseignée' }}
                        </li>

                        <li class="list-group-item">
                            <strong>Bio :</strong> <br>
                            <span class="text-muted">{{ auth()->user()->bio ?? 'Aucune biographie...' }}</span>
                        </li>

                    </ul>

                </div>
            </div>

            {{-- Module devenir contributeur (déjà fait) --}}
            @include('front.profil.devenir-contributeur')

        </div>

    </div>

</div>

@endsection
