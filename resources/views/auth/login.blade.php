@extends('auth.layout')

@section('title', 'Connexion')

@section('content')

<h2 class="auth-title mb-4 text-center">
    <i class="bi bi-box-arrow-in-right"></i> Connexion
</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    {{-- Email --}}
    <div class="mb-3">
        <label class="form-label">Adresse email</label>
        <input type="email" class="form-control rounded-3" name="email" required autofocus>
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" class="form-control rounded-3" name="password" required>
    </div>

    {{-- Remember --}}
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
    </div>

    <button class="btn btn-gold w-100 mb-3">Se connecter</button>

    <div class="text-center">
        <a href="{{ route('password.request') }}" class="link-light">Mot de passe oublié ?</a>
    </div>

    <hr class="my-3 text-white">

    <div class="text-center">
        <a href="{{ route('register') }}" class="link-light">
            Pas encore de compte ? <strong>Créer un compte</strong>
        </a>
    </div>
</form>

@endsection
