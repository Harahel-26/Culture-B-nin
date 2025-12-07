@extends('auth.layout')

@section('title', 'Inscription')

@section('content')

<h2 class="auth-title mb-4 text-center">
    <i class="bi bi-person-plus"></i> Créer un compte
</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nom complet</label>
        <input type="text" name="name" class="form-control rounded-3" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Adresse email</label>
        <input type="email" name="email" class="form-control rounded-3" required>
    </div>

    {{-- Le rôle est forcé à "lecteur", caché --}}
    <input type="hidden" name="role" value="lecteur">

    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control rounded-3" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control rounded-3" required>
    </div>

    <button class="btn btn-gold w-100">Créer mon compte</button>

    <hr class="my-3">

    <div class="text-center">
        <a href="{{ route('login') }}" class="link-light">
            Déjà un compte ? <strong>Connexion</strong>
        </a>
    </div>
</form>

@endsection
