@extends('front.layouts.app')

@section('title', 'Modifier profil')

@section('content')

<div class="container py-4">

    <h2 class="fw-bold mb-4"><i class="bi bi-pencil"></i> Modifier le profil</h2>

    <div class="row">

        {{-- MODIFIER INFOS --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('front.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Avatar --}}
                        <label class="form-label fw-semibold">Photo de profil</label>
                        <input type="file" name="avatar" class="form-control mb-3">

                        {{-- Name --}}
                        <label class="form-label fw-semibold">Nom complet</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control mb-3">

                        {{-- Telephone --}}
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text" name="phone" value="{{ auth()->user()->phone }}" class="form-control mb-3">

                        {{-- Adresse --}}
                        <label class="form-label fw-semibold">Adresse</label>
                        <input type="text" name="adresse" value="{{ auth()->user()->adresse }}" class="form-control mb-3">

                        {{-- Bio --}}
                        <label class="form-label fw-semibold">Biographie</label>
                        <textarea name="bio" class="form-control mb-3" rows="4">{{ auth()->user()->bio }}</textarea>

                        <button class="btn btn-gold w-100">Enregistrer</button>

                    </form>

                </div>
            </div>
        </div>


        {{-- CHANGER MOT DE PASSE --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Changer le mot de passe</h5>

                    <form action="{{ route('front.profil.password') }}" method="POST">
                        @csrf

                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control mb-3">

                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control mb-3">

                        <label class="form-label">Confirmer</label>
                        <input type="password" name="password_confirmation" class="form-control mb-3">

                        <button class="btn btn-gold w-100">Mettre à jour</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection
