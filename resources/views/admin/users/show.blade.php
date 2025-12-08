@extends('admin.layouts')

@section('title', 'Profil utilisateur')

@section('content')

<style>
    :root {
        --admin-primary: #1e1b4b;
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-success: #10b981;
        --admin-danger: #ef4444;
        --admin-warning: #f59e0b;
        --admin-light: #f8f9fa;
        --admin-dark: #0f172a;
        --admin-gray: #64748b;
    }

    .profile-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(30, 27, 75, 0.1);
        border: 1px solid rgba(138, 43, 226, 0.1);
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--admin-secondary), var(--admin-accent));
    }

    .user-avatar {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .user-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .user-name {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--admin-primary);
        font-size: 2rem;
        margin-bottom: 5px;
    }

    .user-email {
        color: var(--admin-gray);
        font-size: 1.1rem;
        margin-bottom: 15px;
    }

    .role-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }

    .badge-role {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .profile-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .profile-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--admin-secondary);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(138, 43, 226, 0.1);
    }

    .card-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .card-title {
        font-weight: 600;
        color: var(--admin-primary);
        font-size: 1.3rem;
        margin: 0;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-icon {
        color: var(--admin-secondary);
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        margin-top: 3px;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-weight: 600;
        color: var(--admin-dark);
        margin-bottom: 4px;
        font-size: 0.95rem;
    }

    .info-value {
        color: var(--admin-gray);
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .info-value.empty {
        color: #94a3b8;
        font-style: italic;
    }

    .badge-status {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-active {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .badge-inactive {
        background: linear-gradient(135deg, var(--admin-danger), #dc2626);
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: rgba(138, 43, 226, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(138, 43, 226, 0.1);
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--admin-secondary);
        margin-bottom: 5px;
    }

    .stat-label {
        color: var(--admin-gray);
        font-size: 0.85rem;
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid rgba(138, 43, 226, 0.1);
    }

    .btn-back {
        background: white;
        color: var(--admin-gray);
        border: 2px solid #e2e8f0;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background: var(--admin-light);
        border-color: var(--admin-secondary);
        color: var(--admin-dark);
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(138, 43, 226, 0.3);
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 25px 20px;
        }

        .user-avatar {
            width: 120px;
            height: 120px;
        }

        .user-name {
            font-size: 1.7rem;
        }

        .profile-cards {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-back, .btn-edit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- En-tête du profil -->
<div class="profile-header">
    @if($user->avatar_url)
        <img src="{{ $user->avatar_url }}" class="user-avatar" alt="{{ $user->name }}">
    @else
        <div class="user-avatar"
             style="background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
                    display: flex; align-items: center; justify-content: center; color: white;
                    font-size: 3rem; font-weight: 700;">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    @endif

    <h1 class="user-name">{{ $user->name }}</h1>
    <p class="user-email">{{ $user->email }}</p>

    <div class="role-badges">
        @foreach($user->roles as $role)
            <span class="badge-role">
                <i class="bi bi-person-badge"></i>
                {{ $role->name }}
            </span>
        @endforeach
    </div>
</div>

<!-- Cartes d'informations -->
<div class="profile-cards">
    <!-- Informations personnelles -->
    <div class="profile-card">
        <div class="card-header">
            <div class="card-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <h3 class="card-title">Informations personnelles</h3>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-at"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Nom d'utilisateur</div>
                <div class="info-value {{ !$user->username ? 'empty' : '' }}">
                    {{ $user->username ?? 'Non renseigné' }}
                </div>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-telephone"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Téléphone</div>
                <div class="info-value {{ !$user->phone ? 'empty' : '' }}">
                    {{ $user->phone ?? 'Non renseigné' }}
                </div>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-geo-alt"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Adresse</div>
                <div class="info-value {{ !$user->adresse ? 'empty' : '' }}">
                    {{ $user->adresse ?? 'Non renseignée' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Informations du compte -->
    <div class="profile-card">
        <div class="card-header">
            <div class="card-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <h3 class="card-title">Informations du compte</h3>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-calendar"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Membre depuis</div>
                <div class="info-value">
                    {{ $user->created_at->format('d/m/Y') }}
                    <small class="d-block text-muted">{{ $user->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Dernière connexion</div>
                <div class="info-value">
                    @if($user->last_login_at)
                        {{ $user->last_login_at->format('d/m/Y à H:i') }}
                        <small class="d-block text-muted">{{ $user->last_login_at->diffForHumans() }}</small>
                    @else
                        <span class="empty">Jamais connecté</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-activity"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Statut du compte</div>
                <div class="info-value">
                    @if($user->is_active)
                        <span class="badge-status badge-active">
                            <i class="bi bi-check-circle me-1"></i>
                            Actif
                        </span>
                    @else
                        <span class="badge-status badge-inactive">
                            <i class="bi bi-x-circle me-1"></i>
                            Inactif
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Biographie -->
@if($user->bio)
<div class="profile-card">
    <div class="card-header">
        <div class="card-icon">
            <i class="bi bi-card-text"></i>
        </div>
        <h3 class="card-title">Biographie</h3>
    </div>
    <div class="info-content">
        <p style="color: var(--admin-gray); line-height: 1.6; margin: 0;">
            {{ $user->bio }}
        </p>
    </div>
</div>
@endif

<!-- Statistiques (optionnelles) -->
@if(isset($stats))
<div class="profile-card">
    <div class="card-header">
        <div class="card-icon">
            <i class="bi bi-bar-chart"></i>
        </div>
        <h3 class="card-title">Statistiques</h3>
    </div>
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-number">{{ $stats['comments'] ?? 0 }}</div>
            <div class="stat-label">Commentaires</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['contents'] ?? 0 }}</div>
            <div class="stat-label">Contenus</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['likes'] ?? 0 }}</div>
            <div class="stat-label">Favoris</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['views'] ?? 0 }}</div>
            <div class="stat-label">Vues</div>
        </div>
    </div>
</div>
@endif

<!-- Boutons d'action -->
<div class="action-buttons">
    <a href="{{ route('admin.users.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
        Retour à la liste
    </a>

    <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit">
        <i class="bi bi-pencil"></i>
        Modifier le profil
    </a>
</div>

@endsection
