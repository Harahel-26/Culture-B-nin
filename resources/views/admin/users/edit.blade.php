@extends('admin.layouts')

@section('title', 'Modifier utilisateur')

@section('content')

<style>
    .form-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        position: relative;
        overflow: hidden;
    }
    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, #8a2be2, #1e1b4b);
    }
    .page-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 5px;
    }
    .page-subtitle {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 25px;
        padding-left: 38px;
    }
    .form-label {
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-label i {
        color: #8a2be2;
    }
    .form-control-enhanced, .form-select-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }
    .form-control-enhanced:focus, .form-select-enhanced:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
    }
    .avatar-container {
        text-align: center;
        margin-bottom: 20px;
    }
    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .avatar-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .btn-update {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-update:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-2px);
        color: white;
    }
    .btn-cancel {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-cancel:hover {
        background: #f8f9fa;
        border-color: #9ca3af;
        color: #374151;
    }
</style>

<div class="mb-4">
    <h1 class="page-title">
        <i class="bi bi-pencil-square"></i>
        Modifier l'Utilisateur
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-info-circle"></i>
        Édition de : <strong>{{ $user->name }}</strong>
    </p>
</div>

<div class="form-card">
    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informations personnelles -->
        <h5 class="fw-bold mb-4" style="color: #1e1b4b;">
            <i class="bi bi-person-circle"></i>
            Informations personnelles
        </h5>

        <div class="row g-4">
            <!-- Nom -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-person"></i>
                    Nom complet *
                </label>
                <input type="text" 
                       name="name" 
                       class="form-control-enhanced"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            <!-- Nom d'utilisateur -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-at"></i>
                    Nom d'utilisateur
                </label>
                <input type="text" 
                       name="username" 
                       class="form-control-enhanced"
                       value="{{ old('username', $user->username) }}">
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-envelope"></i>
                    Email *
                </label>
                <input type="email" 
                       name="email" 
                       class="form-control-enhanced"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            <!-- Téléphone -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-telephone"></i>
                    Téléphone
                </label>
                <input type="text" 
                       name="phone" 
                       class="form-control-enhanced"
                       value="{{ old('phone', $user->phone) }}">
            </div>

            <!-- Adresse -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-geo-alt"></i>
                    Adresse
                </label>
                <input type="text" 
                       name="adresse" 
                       class="form-control-enhanced"
                       value="{{ old('adresse', $user->adresse) }}">
            </div>

            <!-- Biographie -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-card-text"></i>
                    Biographie
                </label>
                <textarea name="bio" 
                          class="form-control-enhanced" 
                          rows="3">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <!-- Mot de passe -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-lock"></i>
                    Nouveau mot de passe
                </label>
                <input type="password" 
                       name="password" 
                       class="form-control-enhanced"
                       placeholder="Laisser vide pour ne pas modifier">
            </div>

            <!-- Confirmation mot de passe -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-lock-fill"></i>
                    Confirmation
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       class="form-control-enhanced"
                       placeholder="Confirmer le nouveau mot de passe">
            </div>

            <!-- Rôle -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-shield-check"></i>
                    Rôle *
                </label>
                <select name="role" class="form-select-enhanced" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" @selected($user->hasRole($role->name))>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Avatar -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-image"></i>
                    Photo de profil
                </label>
                <div class="avatar-container">
                    <img id="avatarPreview" 
                         class="avatar-preview"
                         src="{{ $user->avatar_url }}"
                         alt="Avatar de {{ $user->name }}"
                         onclick="document.getElementById('avatarInput').click()">
                    
                    <div class="text-muted small">Cliquez sur l'image pour changer</div>
                    <input type="file" 
                           name="avatar" 
                           id="avatarInput" 
                           class="d-none"
                           accept="image/*"
                           onchange="previewAvatar(event)">
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-5 pt-4 border-top">
            <button type="submit" class="btn-update">
                <i class="bi bi-save"></i>
                Mettre à jour
            </button>
            
            <a href="{{ route('admin.users.index') }}" class="btn-cancel ms-3">
                Annuler
            </a>
        </div>
    </form>
</div>

<script>
    function previewAvatar(event) {
        const input = event.target;
        const preview = document.getElementById('avatarPreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection