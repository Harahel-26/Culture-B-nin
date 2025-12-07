@extends('front.layouts.app')

@section('title', 'Contact')

@section('content')

<div class="container py-5">

    <h1 class="fw-bold mb-4 text-center">
        <i class="bi bi-envelope-open"></i> Contactez-nous
    </h1>

    <p class="text-center text-muted mb-5">
        Pour toute question, suggestion ou collaboration, écrivez-nous.
    </p>

    <div class="row justify-content-center">
        <div class="col-md-7">

            @if(session('success'))
                <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('front.contact.send') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nom complet</label>
                            <input type="text" name="name" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email" name="email" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Votre message</label>
                            <textarea name="message" class="form-control rounded-3" rows="5" required></textarea>
                        </div>

                        <button class="btn btn-gold w-100 py-2">
                            <i class="bi bi-send"></i> Envoyer le message
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
