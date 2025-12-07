@extends('auth.layout')

@section('title', 'Réinitialisation')

@section('content')

<h2 class="auth-title mb-4 text-center">
    <i class="bi bi-shield-lock"></i> Nouveau mot de passe
</h2>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="mb-3">
        <label class="form-label">Adresse email</label>
        <input type="email" name="email" value="{{ old('email', $request->email) }}"
               class="form-control rounded-3" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nouveau mot de passe</label>
        <input type="password" name="password" class="form-control rounded-3" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirmer</label>
        <input type="password" name="password_confirmation" class="form-control rounded-3" required>
    </div>

    <button class="btn btn-gold w-100">Changer le mot de passe</button>

</form>

@endsection
