@extends('auth.layout')

@section('title', 'Vérification email')

@section('content')

<h2 class="auth-title mb-4 text-center">
    <i class="bi bi-envelope-check"></i> Vérifiez votre email
</h2>

<p class="text-white-50 mb-4">
    Un lien de confirmation a été envoyé à votre adresse email.
</p>

@if(session('status') === 'verification-link-sent')
    <div class="alert alert-success">
        Un nouveau lien a été envoyé ! Vérifiez votre boîte mail.
    </div>
@endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button class="btn btn-gold w-100 mb-3">
        Renvoyer le lien
    </button>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-secondary w-100">
        Se déconnecter
    </button>
</form>

@endsection
