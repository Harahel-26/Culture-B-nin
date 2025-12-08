@extends('admin.layouts')

@section('title', 'Modifier utilisateur')

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
        --admin-warning: #f59e0b;
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

    .user-highlight {
        background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
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

    .btn-update {
        background: linear-gradient(135deg, var(--admin-success), #059669);
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

    .btn-update:hover {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
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

    .user-info-card {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(99, 102, 241, 0.05));
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
        border-left: 4px solid var(--admin-secondary);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        color: var(--admin-dark);
    }

    .info-item i {
        color: var(--admin-secondary);
        width: 20px;
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

        .btn-update, .btn-cancel {
            width: 100%;
            justify-content: center;
        }
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

    .alert-success {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        border-left: 4px solid var(--admin-success);
    }

    .alert ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
</style>

<div class="mb-5">
    <h1 class="page-title">
        <i class="bi bi-pencil-square"></i>
        Modifier l'Utilisateur
    </h1>
    <p class="page-subtitle">
        Édition de : <span class="user-highlight">{{ $user->name }}</span>
    </p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

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

<!-- Informations utilisateur -->
<div class="user-info-card">
    <div class="row">
        <div class="col-md-6">
            <div class="info-item">
                <i class="bi bi-envelope"></i>
                <strong>Email :</strong> {{ $user->email }}
            </div>
            <div class="info-item">
                <i class="bi bi-person-badge"></i>
                <strong>Rôle :</strong> {{ $user->getRoleNames()->first() ?? 'Aucun rôle' }}
            </div>
            <div class="info-item">
                <i class="bi bi-calendar"></i>
                <strong>Inscrit le :</strong> {{ $user->created_at->format('d/m/Y') }}
            </div>
        </div>
        <div class="col-md-6">
            @if($user->phone)
            <div class="info-item">
                <i class="bi bi-telephone"></i>
                <strong>Téléphone :</strong> {{ $user->phone }}
            </div>
            @endif
            @if($user->adresse)
            <div class="info-item">
                <i class="bi bi-geo-alt"></i>
                <strong>Adresse :</strong> {{ $user->adresse }}
            </div>
            @endif
            <div class="info-item">
                <i class="bi bi-clock-history"></i>
                <strong>Dernière mise à jour :</strong> {{ $user->updated_at->diffForHumans() }}
            </div>
        </div>
    </div>
</div>

<div class="form-card">
    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                       value="{{ old('name', $user->name) }}"
                       required>
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
                       value="{{ old('username', $user->username) }}">
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
                       value="{{ old('email', $user->email) }}"
                       required>
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
                       value="{{ old('phone', $user->phone) }}"
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
                       class="form-control"
                       value="{{ old('adresse', $user->adresse) }}"
                       placeholder="Adresse complète">
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
                          placeholder="Présentation de l'utilisateur...">{{ old('bio', $user->bio) }}</textarea>
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
                        Nouveau mot de passe
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Laisser vide pour ne pas modifier">
                    <button type="button" class="password-toggle">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <span class="form-hint">Laissez vide pour conserver l'actuel</span>
            </div>

            <!-- Confirmation mot de passe -->
            <div class="col-md-6">
                <div class="password-wrapper">
                    <label class="form-label">
                        <i class="bi bi-lock-fill"></i>
                        Confirmer le mot de passe
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirmer le nouveau mot de passe">
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
                        <option value="{{ $role->id }}" {{ $user->hasRole($role->name) || old('role') == $role->id ? 'selected' : '' }}>
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
                         src="{{ $user->avatar_url }}"
                         alt="Avatar de {{ $user->name }}"
                         onclick="document.getElementById('avatarInput').click()">

                    <input type="file"
                           name="avatar"
                           id="avatarInput"
                           class="d-none"
                           accept="image/*"
                           onchange="previewAvatar(event)">

                    <div class="avatar-hint">
                        <i class="bi bi-info-circle me-1"></i>
                        Cliquez sur l'image pour changer la photo
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions-container">
            <button type="submit" class="btn-update">
                <i class="bi bi-save"></i>
                Mettre à jour
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
