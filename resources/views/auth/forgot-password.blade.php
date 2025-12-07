@extends('auth.layout')

@section('title', 'Mot de passe oublié')

@section('content')

<h2 class="auth-title mb-4 text-center">
    <i class="bi bi-unlock"></i> Mot de passe oublié
</h2>

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <p class="text-white-50 mb-3">
        Entrez votre email et nous vous enverrons un lien de réinitialisation.
    </p>

    <div class="mb-3">
        <label class="form-label">Adresse email</label>
        <input type="email" name="email" class="form-control rounded-3" required autofocus>
    </div>

    <button class="btn btn-gold w-100">Envoyer le lien</button>

</form>

@endsection
