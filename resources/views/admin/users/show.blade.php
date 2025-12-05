@extends('admin.layouts')

@section('title', 'Profil utilisateur')

@section('content')

<style>
    .avatar-large {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #d4a017;
    }
    .info-title {
        font-weight: 700;
        font-size: 1.2rem;
        color: #1e1b4b;
    }
</style>

<div class="text-center mb-4">

    <img src="{{ $user->avatar_url }}" class="avatar-large mb-3">

    <h2 class="fw-bold" style="color:#1e1b4b;">{{ $user->name }}</h2>

    <p class="text-muted">{{ $user->email }}</p>

    @foreach($user->roles as $role)
        <span class="badge-role">{{ $role->name }}</span>
    @endforeach

</div>

<div class="card shadow-sm p-4">

    <h4 class="info-title">Informations</h4>
    <p><strong>Nom d'utilisateur :</strong> {{ $user->username }}</p>
    <p><strong>Téléphone :</strong> {{ $user->phone ?? 'Non renseigné' }}</p>
    <p><strong>Adresse :</strong> {{ $user->adresse ?? 'Non renseignée' }}</p>
    <p><strong>Bio :</strong> {{ $user->bio ?? 'Aucune biographie.' }}</p>

    <h4 class="info-title mt-4">Statut du compte</h4>
    <p>
        @if($user->is_active)
            <span class="badge-active">Actif</span>
        @else
            <span class="badge-inactive">Inactif</span>
        @endif
    </p>

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">
        Retour
    </a>

</div>

@endsection
