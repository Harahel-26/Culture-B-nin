@extends('auth.layout')

@section('title', 'Confirmer')

@section('content')

<h2 class="auth-title mb-4 text-center">
    <i class="bi bi-shield-check"></i> Confirmer l'action
</h2>

<p class="text-white-50">
    Pour des raisons de sécurité, veuillez confirmer votre mot de passe.
</p>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="mb-3 mt-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control rounded-3" required>
    </div>

    <button class="btn btn-gold w-100">
        Confirmer
    </button>
</form>

@endsection
