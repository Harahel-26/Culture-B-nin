@extends('admin.layouts')

@section('page-title', 'Ajouter un utilisateur')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
    <li class="breadcrumb-item active">Créer</li>
@endsection

@section('content')

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h4 class="card-title mb-0">Créer un nouvel utilisateur</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Nom complet -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Adresse email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Rôle -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rôle</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Choisir un rôle --</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Confirm -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirmer mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Annuler
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Créer l’utilisateur
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
