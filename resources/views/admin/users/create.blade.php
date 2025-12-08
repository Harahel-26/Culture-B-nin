@extends('admin.layouts')

@section('title', 'Créer un utilisateur')

@section('content')

<style>
    :root {
        --admin-primary: #1e1b4b;
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-light: #f8f9fa;
        --admin-dark: #0f172a;
        --admin-gray: #64748b;
        --admin-success: #10b981;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(30, 27, 75, 0.1);
        border: 1px solid rgba(138, 43, 226, 0.1);
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--admin-secondary), var(--admin-accent));
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--admin-primary);
        font-size: 2.2rem;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
    }

    .page-title i {
        background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2rem;
    }

    .page-subtitle {
        color: var(--admin-gray);
        font-size: 1.1rem;
        margin-bottom: 30px;
        padding-left: 55px;
        line-height: 1.5;
    }

    .section-title {
        font-weight: 600;
        color: var(--admin-primary);
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(138, 43, 226, 0.2);
    }

    .section-title i {
        color: var(--admin-secondary);
    }

    .form-label {
        font-weight: 600;
        color: var(--admin-dark);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .form-label i {
        color: var(--admin-secondary);
        width: 20px;
        text-align: center;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--admin-secondary);
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
    }

    .avatar-container {
        text-align: center;
        padding: 20px;
        background: var(--admin-light);
        border-radius: 15px;
        border: 2px dashed #e2e8f0;
        transition: all 0.3s ease;
    }

    .avatar-container:hover {
        border-color: var(--admin-secondary);
        background: rgba(138, 43, 226, 0.05);
    }

    .avatar-preview {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .avatar-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .avatar-hint {
        color: var(--admin-gray);
        font-size: 0.85rem;
        margin-top: 10px;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(138, 43, 226, 0.3);
    }

    .btn-cancel {
        background: white;
        color: var(--admin-gray);
        border: 2px solid #e2e8f0;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: var(--admin-light);
        border-color: var(--admin-secondary);
        color: var(--admin-dark);
    }

    .required-marker {
        color: #ef4444;
        margin-left: 4px;
    }

    .form-hint {
        font-size: 0.85rem;
        color: var(--admin-gray);
        margin-top: 5px;
        display: block;
    }

    .password-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--admin-gray);
        cursor: pointer;
    }

    .actions-container {
        padding-top: 30px;
        margin-top: 30px;
        border-top: 2px solid rgba(138, 43, 226, 0.1);
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 25px 20px;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .page-subtitle {
            padding-left: 0;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
        }

        .actions-container {
            flex-direction: column;
        }

        .btn-submit, .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }

    .field-group {
        margin-bottom: 25px;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 25px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .alert ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
</style>

<div class="mb-5">
    <h1 class="page-title">
        <i class="bi bi-person-plus"></i>
        Nouvel Utilisateur
    </h1>
    <p class="page-subtitle">
        Créez un nouveau compte utilisateur pour la plateforme Culture Bénin
    </p>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong><i class="bi bi-exclamation-triangle me-2"></i>Veuillez corriger les erreurs suivantes :</strong>
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-card">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Informations personnelles -->
        <h5 class="section-title">
            <i class="bi bi-person-circle"></i>
            Informations personnelles
        </h5>

        <div class="row g-4">
            <!-- Nom -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-person"></i>
                    Nom complet
                    <span class="required-marker">*</span>
                </label>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Ex: Jean Dupont"
                       required
                       value="{{ old('name') }}">
                <span class="form-hint">Le nom complet de l'utilisateur</span>
            </div>

            <!-- Nom d'utilisateur -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-at"></i>
                    Nom d'utilisateur
                </label>
                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Ex: jeandupont"
                       value="{{ old('username') }}">
                <span class="form-hint">Optionnel - pour la connexion</span>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-envelope"></i>
                    Email
                    <span class="required-marker">*</span>
                </label>
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="exemple@email.com"
                       required
                       value="{{ old('email') }}">
                <span class="form-hint">L'adresse email de l'utilisateur</span>
            </div>

            <!-- Téléphone -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-telephone"></i>
                    Téléphone
                </label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       placeholder="+229 XX XX XX XX"
                       value="{{ old('phone') }}">
            </div>

            <!-- Adresse -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-geo-alt"></i>
                    Adresse
                </label>
                <input type="text"
                       name="adresse"
                       class="form-control"
                       placeholder="Adresse complète"
                       value="{{ old('adresse') }}">
            </div>

            <!-- Biographie -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-card-text"></i>
                    Biographie
                </label>
                <textarea name="bio"
                          class="form-control"
                          rows="3"
                          placeholder="Présentation de l'utilisateur...">{{ old('bio') }}</textarea>
            </div>
        </div>

        <!-- Sécurité et rôle -->
        <h5 class="section-title mt-5">
            <i class="bi bi-shield-check"></i>
            Sécurité et rôle
        </h5>

        <div class="row g-4">
            <!-- Mot de passe -->
            <div class="col-md-6">
                <div class="password-wrapper">
                    <label class="form-label">
                        <i class="bi bi-lock"></i>
                        Mot de passe
                        <span class="required-marker">*</span>
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="••••••••"
                           required>
                    <button type="button" class="password-toggle">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <span class="form-hint">Minimum 8 caractères</span>
            </div>

            <!-- Confirmation mot de passe -->
            <div class="col-md-6">
                <div class="password-wrapper">
                    <label class="form-label">
                        <i class="bi bi-lock-fill"></i>
                        Confirmer le mot de passe
                        <span class="required-marker">*</span>
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="••••••••"
                           required>
                    <button type="button" class="password-toggle">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Rôle -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-person-badge"></i>
                    Rôle
                    <span class="required-marker">*</span>
                </label>
                <select name="role" class="form-select" required>
                    <option value="">Sélectionner un rôle</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                <span class="form-hint">Définit les permissions de l'utilisateur</span>
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
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140' viewBox='0 0 140 140'%3E%3Ccircle cx='70' cy='70' r='70' fill='%23f8f9fa'/%3E%3Ctext x='50%25' y='50%25' font-family='Arial' font-size='56' fill='%238a2be2' text-anchor='middle' dy='.3em'%3E👤%3C/text%3E%3C/svg%3E"
                         alt="Aperçu avatar"
                         onclick="document.getElementById('avatarInput').click()">

                    <input type="file"
                           name="avatar"
                           id="avatarInput"
                           class="d-none"
                           accept="image/*"
                           onchange="previewAvatar(event)">

                    <div class="avatar-hint">
                        <i class="bi bi-info-circle me-1"></i>
                        Cliquez sur l'image pour télécharger une photo
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions-container">
            <button type="submit" class="btn-submit">
                <i class="bi bi-save"></i>
                Créer l'utilisateur
            </button>

            <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                <i class="bi bi-x-circle"></i>
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

    // Toggle password visibility
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.innerHTML = type === 'password'
                ? '<i class="bi bi-eye"></i>'
                : '<i class="bi bi-eye-slash"></i>';
        });
    });

    // Auto-focus on first input
    document.addEventListener('DOMContentLoaded', function() {
        const firstInput = document.querySelector('input[name="name"]');
        if (firstInput) firstInput.focus();
    });
</script>

@endsection
