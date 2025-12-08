@extends('admin.layouts')

@section('title', 'Créer un utilisateur')

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
    .btn-save {
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
    .btn-save:hover {
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
        <i class="bi bi-person-plus"></i>
        Nouvel Utilisateur
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-info-circle"></i>
        Créez un nouveau compte utilisateur pour votre plateforme
    </p>
</div>

<div class="form-card">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                       placeholder="Ex: Jean Dupont"
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
                       placeholder="Ex: jeandupont">
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
                       placeholder="exemple@email.com"
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
                       placeholder="+229 XX XX XX XX">
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
                       placeholder="Adresse complète">
            </div>

            <!-- Biographie -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-card-text"></i>
                    Biographie
                </label>
                <textarea name="bio" 
                          class="form-control-enhanced" 
                          rows="3"
                          placeholder="Présentation de l'utilisateur..."></textarea>
            </div>

            <!-- Mot de passe -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-lock"></i>
                    Mot de passe *
                </label>
                <input type="password" 
                       name="password" 
                       class="form-control-enhanced"
                       placeholder="••••••••"
                       required>
            </div>

            <!-- Confirmation mot de passe -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-lock-fill"></i>
                    Confirmation *
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       class="form-control-enhanced"
                       placeholder="••••••••"
                       required>
            </div>

            <!-- Rôle -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-shield-check"></i>
                    Rôle *
                </label>
                <select name="role" class="form-select-enhanced" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">
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
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 120 120'%3E%3Ccircle cx='60' cy='60' r='60' fill='%23f3f4f6'/%3E%3Ctext x='50%25' y='50%25' font-family='Arial' font-size='48' fill='%239ca3af' text-anchor='middle' dy='.3em'%3E👤%3C/text%3E%3C/svg%3E"
                         alt="Aperçu avatar"
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
            <button type="submit" class="btn-save">
                <i class="bi bi-save"></i>
                Créer l'utilisateur
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