@extends('layouts')

@section('page-title', 'Modifier utilisateur')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('utilisateurs.index') }}">Utilisateurs</a></li>
<li class="breadcrumb-item active">Modifier</li>
@endsection

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-white">
        <h4 class="card-title mb-0">Modifier l’utilisateur</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('utilisateurs.update', $utilisateur) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <!-- Prénom -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control"
                        value="{{ old('prenom', $utilisateur->prenom) }}" required>
                    @error('prenom') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Nom -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control"
                        value="{{ old('nom', $utilisateur->nom) }}" required>
                    @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $utilisateur->email) }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Rôle Spatie -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Choisir un rôle --</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $utilisateur->roles->first()->id ?? null == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Statut -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Statut</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ $utilisateur->is_active ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !$utilisateur->is_active ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <!-- Nouveau mot de passe -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nouveau mot de passe (optionnel)</label>
                    <input type="password" name="password" class="form-control">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Confirmation -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirmer nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

            </div>

            <div class="text-end mt-3">
                <a href="{{ route('utilisateurs.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Annuler
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Mettre à jour
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
