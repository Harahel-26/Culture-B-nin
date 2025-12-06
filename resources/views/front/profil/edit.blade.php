@extends('front.layouts.app')

@section('title', 'Mon profil')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5">
        <h1 class="fw-bold text-white">Mon profil</h1>
        <p class="text-light">Gérez vos informations personnelles</p>
    </div>
</section>
@endsection

@section('content')

<style>
    .profile-card {
        background:#fff;
        padding:25px;
        border-radius:14px;
        box-shadow:0 4px 16px rgba(0,0,0,0.08);
    }
    
    .avatar-preview {
        width:120px;
        height:120px;
        object-fit:cover;
        border-radius:50%;
        border:3px solid #d4a017;
        box-shadow:0 4px 12px rgba(0,0,0,0.15);
        margin-bottom:15px;
    }
</style>

<div class="container">

    <div class="row g-4">

        {{-- ⭐ SECTION PROFIL --}}
        <div class="col-md-6">
            <div class="profile-card">

                <h4 class="fw-bold mb-3" style="color:#1e1b4b;">Informations du profil</h4>

                {{-- AVATAR --}}
                <div class="text-center mb-3">
                    <img id="avatarPreview"
                         src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}"
                         class="avatar-preview">
                </div>

                <form action="{{ route('front.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $user->name }}" required>
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ $user->phone }}">
                    </div>

                    {{-- Bio --}}
                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3">{{ $user->bio }}</textarea>
                    </div>

                    {{-- Avatar --}}
                    <div class="mb-3">
                        <label class="form-label">Photo de profil</label>
                        <input type="file" name="avatar" class="form-control"
                               onchange="previewAvatar(event)">
                    </div>

                    <button class="btn btn-gold w-100">Mettre à jour</button>

                </form>

            </div>
        </div>


        {{-- ⭐ SECTION MOT DE PASSE --}}
        <div class="col-md-6">
            <div class="profile-card">

                <h4 class="fw-bold mb-3" style="color:#1e1b4b;">Changer de mot de passe</h4>

                <form action="{{ route('front.profil.password') }}" method="POST">
                    @csrf

                    {{-- Current password --}}
                    <div class="mb-3">
                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>

                    {{-- New password --}}
                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    {{-- Confirm --}}
                    <div class="mb-3">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">Mettre à jour</button>

                </form>

            </div>
        </div>

    </div>
</div>

<script>
function previewAvatar(event) {
    const output = document.getElementById('avatarPreview');
    output.src = URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection
