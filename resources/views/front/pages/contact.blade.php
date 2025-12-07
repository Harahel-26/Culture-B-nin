@extends('front.layouts.app')

@section('title', 'Contact – Culture Bénin')

@section('content')

<h1 class="fw-bold mb-3">Nous contacter</h1>

<div class="row g-4">
    <div class="col-md-6">
        <p class="text-muted">
            Une question, une suggestion, une collaboration ou un projet autour de la culture béninoise ?
            N’hésitez pas à nous écrire via ce formulaire.
        </p>

        <form method="POST" action="{{ route('front.contact.send') }}" class="card p-3 shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nom complet</label>
                <input type="text" name="name" class="form-control" required
                       value="{{ old('name', auth()->user()->name ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control" required
                       value="{{ old('email', auth()->user()->email ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Sujet</label>
                <input type="text" name="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" rows="5" class="form-control" required></textarea>
            </div>

            <button class="btn btn-gold">
                <i class="bi bi-send"></i> Envoyer
            </button>

        </form>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3">
            <h5 class="fw-bold mb-2">Informations</h5>
            <p class="mb-1"><i class="bi bi-envelope"></i> contact@culture-benin.bj</p>
            <p class="mb-1"><i class="bi bi-geo-alt"></i> Cotonou, Bénin</p>
            <p class="mb-1"><i class="bi bi-clock"></i> Lun - Ven : 9h - 18h</p>
        </div>
    </div>
</div>

@endsection
