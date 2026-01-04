@extends('admin.layouts')

@section('title', 'Gestion des utilisateurs')

@section('content')

<style>
    :root {
        --admin-primary: #1e1b4b;
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-success: #10b981;
        --admin-danger: #ef4444;
        --admin-warning: #f59e0b;
        --admin-info: #0ea5e9;
        --admin-light: #f8f9fa;
        --admin-dark: #0f172a;
        --admin-gray: #64748b;
    }

    .header-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(30, 27, 75, 0.1);
        border: 1px solid rgba(138, 43, 226, 0.1);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .header-card::before {
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
        margin: 0;
    }

    .page-subtitle {
        color: var(--admin-gray);
        font-size: 1rem;
        margin-top: 8px;
        margin-bottom: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--admin-secondary);
    }


.user-default-avatar {
    background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
}

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.5rem;
        color: white;
    }

    .stat-total .stat-icon { background: linear-gradient(135deg, var(--admin-secondary), #7c3aed); }
    .stat-active .stat-icon { background: linear-gradient(135deg, var(--admin-success), #059669); }
    .stat-inactive .stat-icon { background: linear-gradient(135deg, var(--admin-danger), #dc2626); }
    .stat-admins .stat-icon { background: linear-gradient(135deg, var(--admin-accent), #4f46e5); }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--admin-primary);
        margin-bottom: 5px;
    }

    .stat-label {
        color: var(--admin-gray);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .btn-create {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-create:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(138, 43, 226, 0.3);
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .user-avatar:hover {
        transform: scale(1.1);
        border-color: var(--admin-secondary);
    }

    .badge-role {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        color: white;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-status {
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-active {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .badge-inactive {
        background: linear-gradient(135deg, var(--admin-danger), #dc2626);
        color: white;
    }

    .table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(30, 27, 75, 0.1);
        border: 1px solid rgba(138, 43, 226, 0.1);
        margin-bottom: 30px;
    }

    .table-header {
        background: linear-gradient(135deg, var(--admin-primary), #2a2470);
        color: white;
        padding: 20px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .user-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .user-table thead th {
        background: var(--admin-light);
        color: var(--admin-dark);
        font-weight: 600;
        padding: 18px 20px;
        border-bottom: 2px solid #e2e8f0;
        text-align: left;
        white-space: nowrap;
    }

    .user-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .user-table tbody tr:hover {
        background: rgba(138, 43, 226, 0.03);
    }

    .user-table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        color: var(--admin-dark);
        border-bottom: 1px solid #f1f5f9;
    }

    .user-table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-name {
        font-weight: 600;
        color: var(--admin-primary);
    }

    .user-username {
        color: var(--admin-gray);
        font-size: 0.85rem;
        margin-top: 3px;
        display: block;
    }

    .user-email {
        color: var(--admin-dark);
        word-break: break-all;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-view {
        background: linear-gradient(135deg, var(--admin-accent), #4f46e5);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--admin-warning), #d97706);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, var(--admin-danger), #dc2626);
        color: white;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .no-data {
        text-align: center;
        padding: 60px 20px;
        color: var(--admin-gray);
    }

    .no-data i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #cbd5e1;
    }

    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 25px;
        padding: 16px 20px;
    }

    .alert-success {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .pagination-container {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        border-color: var(--admin-secondary);
        color: white;
    }

    .pagination .page-link {
        color: var(--admin-secondary);
        border: 1px solid #e2e8f0;
        margin: 0 3px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: rgba(138, 43, 226, 0.1);
        border-color: var(--admin-secondary);
    }

    .search-box {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 300px;
        transition: all 0.3s ease;
    }

    .search-box:focus-within {
        border-color: var(--admin-secondary);
        box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
    }

    .search-box input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .header-card {
            padding: 20px;
        }

        .table-container {
            border-radius: 15px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 32px;
            height: 32px;
        }
    }
</style>

<!-- En-tête avec statistiques -->
<div class="header-card">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div>
            <h1 class="page-title">
                <i class="bi bi-people-fill"></i>
                Gestion des Utilisateurs
            </h1>
            <p class="page-subtitle">
                Gérez et supervisez tous les utilisateurs de la plateforme Culture Bénin
            </p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-create mt-3 mt-md-0">
            <i class="bi bi-plus-circle"></i>
            Nouvel utilisateur
        </a>
    </div>

    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-number">{{ $users->total() }}</div>
            <div class="stat-label">Utilisateurs total</div>
        </div>

        <div class="stat-card stat-active">
            <div class="stat-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-number">{{ $activeCount ?? 0 }}</div>
            <div class="stat-label">Utilisateurs actifs</div>
        </div>

        <div class="stat-card stat-inactive">
            <div class="stat-icon">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-number">{{ $inactiveCount ?? 0 }}</div>
            <div class="stat-label">Utilisateurs inactifs</div>
        </div>

        <div class="stat-card stat-admins">
            <div class="stat-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="stat-number">{{ $adminCount ?? 0 }}</div>
            <div class="stat-label">Administrateurs</div>
        </div>
    </div>
</div>


<!-- Tableau des utilisateurs -->
<div class="table-container">
    <div class="table-header">
        <h3>
            <i class="bi bi-list-ul"></i>
            Liste des utilisateurs
        </h3>
    </div>

    @if($users->count() > 0)
    <div class="table-responsive">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($user->avatar_url)
                                <img src="{{ $user->avatar_url }}" class="user-avatar" alt="{{ $user->name }}">
                            @else
                                <div class="user-avatar user-default-avatar">
                                         {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="user-name">{{ $user->name }}</div>
                                @if($user->username)
                                <div class="user-username">{{ $user->username }}</div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <td class="user-email">{{ $user->email }}</td>

                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge-role">{{ $role->name }}</span>
                        @endforeach
                    </td>

                    <td>
                        @if($user->is_active)
                            <span class="badge-status badge-active">Actif</span>
                        @else
                            <span class="badge-status badge-inactive">Inactif</span>
                        @endif
                    </td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.users.show', $user) }}"
                               class="btn-action btn-view"
                               title="Voir détails">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="btn-action btn-edit"
                               title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn-action btn-delete"
                                        title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="no-data">
        <i class="bi bi-person-x"></i>
        <h4 class="mt-3 mb-2">Aucun utilisateur trouvé</h4>
        <p class="text-muted mb-4">Commencez par créer votre premier utilisateur</p>
        <a href="{{ route('admin.users.create') }}" class="btn-create">
            <i class="bi bi-plus-circle"></i>
            Créer un utilisateur
        </a>
    </div>
    @endif
</div>

<!-- Pagination -->
@if($users->hasPages())
<div class="pagination-container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted">
            Affichage de <strong>{{ $users->firstItem() }}</strong> à <strong>{{ $users->lastItem() }}</strong>
            sur <strong>{{ $users->total() }}</strong> utilisateurs
        </div>
        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endif

<script>
    // Confirmation de suppression améliorée
    document.querySelectorAll('form[onsubmit]').forEach(form => {
        form.onsubmit = function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
                e.preventDefault();
                return false;
            }
            return true;
        };
    });

    // Animation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.user-table tbody tr');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            row.classList.add('animate__animated', 'animate__fadeInUp');
        });
    });
</script>

@endsection
