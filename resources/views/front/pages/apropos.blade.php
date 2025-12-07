@extends('front.layouts.app')

@section('title', 'À propos – Culture Bénin')

@section('content')

<div class="row g-4">
    <div class="col-md-7">
        <h1 class="fw-bold mb-3">À propos de Culture Bénin</h1>
        <p class="text-muted">
            Culture Bénin est une plateforme numérique dédiée à la valorisation, la conservation et
            la diffusion du patrimoine culturel béninois : langues, récits, arts, musiques, savoir-faire
            et traditions.
        </p>
        <p>
            L’objectif est d’offrir un espace moderne, accessible et collaboratif où contributeurs,
            chercheurs, passionnés et curieux peuvent partager et découvrir des contenus fiables et
            structurés autour de la culture béninoise.
        </p>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-3">
            <h5 class="fw-bold mb-2">Nos axes</h5>
            <ul class="list-unstyled">
                <li><i class="bi bi-check-circle text-success"></i> Promotion des langues locales</li>
                <li><i class="bi bi-check-circle text-success"></i> Mise en avant des régions et patrimoines</li>
                <li><i class="bi bi-check-circle text-success"></i> Contenus premium pour soutenir les créateurs</li>
                <li><i class="bi bi-check-circle text-success"></i> Plateforme participative</li>
            </ul>
        </div>
    </div>
</div>

@endsection
