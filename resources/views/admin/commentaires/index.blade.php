@extends('admin.layouts')

@section('title', 'Gestion des commentaires')

@section('content')

<style>
    :root {
        --admin-primary: #1e1b4b;
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
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
        max-width: 600px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .stat-total::before { background: linear-gradient(90deg, var(--admin-secondary), var(--admin-accent)); }
    .stat-pending::before { background: linear-gradient(90deg, var(--admin-warning), #fbbf24); }
    .stat-validated::before { background: linear-gradient(90deg, var(--admin-success), #34d399); }
    .stat-rejected::before { background: linear-gradient(90deg, var(--admin-danger), #f87171); }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
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
    .stat-pending .stat-icon { background: linear-gradient(135deg, var(--admin-warning), #d97706); }
    .stat-validated .stat-icon { background: linear-gradient(135deg, var(--admin-success), #059669); }
    .stat-rejected .stat-icon { background: linear-gradient(135deg, var(--admin-danger), #dc2626); }

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
        display: block;
    }

    .filter-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
    }

    .filter-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
    }

    .filter-select:focus {
        border-color: var(--admin-secondary);
        box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
        outline: none;
    }

    .btn-filter {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-filter:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(138, 43, 226, 0.2);
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

    .comment-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .comment-table thead th {
        background: var(--admin-light);
        color: var(--admin-dark);
        font-weight: 600;
        padding: 18px 20px;
        border-bottom: 2px solid #e2e8f0;
        text-align: left;
        white-space: nowrap;
    }

    .comment-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .comment-table tbody tr:hover {
        background: rgba(138, 43, 226, 0.03);
    }

    .comment-table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        color: var(--admin-dark);
        border-bottom: 1px solid #f1f5f9;
    }

    .comment-table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-name {
        font-weight: 600;
        color: var(--admin-primary);
    }

    .user-email {
        color: var(--admin-gray);
        font-size: 0.85rem;
        display: block;
    }

    .content-title {
        font-weight: 600;
        color: var(--admin-dark);
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .stars-rating {
        font-size: 1.1rem;
        letter-spacing: 2px;
    }

    .stars-rating .bi-star-fill {
        color: #f59e0b;
    }

    .stars-rating .bi-star {
        color: #e5e7eb;
    }

    .comment-text {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: var(--admin-dark);
        font-size: 0.95rem;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background: linear-gradient(135deg, var(--admin-warning), #d97706);
        color: white;
    }

    .badge-validated {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .badge-rejected {
        background: linear-gradient(135deg, var(--admin-danger), #dc2626);
        color: white;
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

    .btn-validate {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .btn-reject {
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

    .btn-action:disabled {
        opacity: 0.5;
        cursor: not-allowed;
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

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 32px;
            height: 32px;
        }

        .comment-text {
            max-width: 150px;
        }
    }
</style>

<!-- En-tête -->
<div class="header-card">
    <div class="mb-4">
        <h1 class="page-title">
            <i class="bi bi-chat-text"></i>
            Gestion des Commentaires
        </h1>
        <p class="page-subtitle">
            Modérez et gérez les avis des visiteurs sur les contenus culturels du Bénin
        </p>
    </div>

    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
            <div class="stat-label">Total des commentaires</div>
        </div>

        <div class="stat-card stat-pending">
            <div class="stat-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-number">{{ $stats['pending'] ?? 0 }}</div>
            <div class="stat-label">En attente</div>
        </div>

        <div class="stat-card stat-validated">
            <div class="stat-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-number">{{ $stats['validated'] ?? 0 }}</div>
            <div class="stat-label">Validés</div>
        </div>

        <div class="stat-card stat-rejected">
            <div class="stat-icon">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-number">{{ $stats['rejected'] ?? 0 }}</div>
            <div class="stat-label">Rejetés</div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Filtres -->
<div class="filter-card">
    <div class="row align-items-center">
        <div class="col-md-8">
            <form method="GET" class="d-flex flex-column flex-md-row gap-3 align-items-start align-items-md-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-funnel" style="color: var(--admin-secondary); font-size: 1.2rem;"></i>
                    <select name="statut" class="form-select filter-select" style="min-width: 220px;">
                        <option value="">Tous les statuts</option>
                        <option value="pending" @selected(request('statut')=='pending')>En attente</option>
                        <option value="validated" @selected(request('statut')=='validated')>Validés</option>
                        <option value="rejected" @selected(request('statut')=='rejected')>Rejetés</option>
                    </select>
                </div>

                <button type="submit" class="btn-filter">
                    <i class="bi bi-sliders"></i>
                    Appliquer le filtre
                </button>

                @if(request('statut'))
                    <a href="{{ route('admin.commentaires.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i>
                        Réinitialiser
                    </a>
                @endif
            </form>
        </div>

        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                {{ $commentaires->total() }} résultat(s) trouvé(s)
            </div>
        </div>
    </div>
</div>

<!-- Tableau des commentaires -->
<div class="table-container">
    <div class="table-header">
        <h3>
            <i class="bi bi-list-ul"></i>
            Liste des commentaires
        </h3>
    </div>

    @if($commentaires->count() > 0)
    <div class="table-responsive">
        <table class="comment-table">
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Contenu</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commentaires as $commentaire)
                <tr>
                    <!-- Auteur -->
                    <td>
                        <div class="user-info">
                            @if($commentaire->utilisateur->avatar_url)
                                <img src="{{ $commentaire->utilisateur->avatar_url }}"
                                     class="user-avatar"
                                     alt="{{ $commentaire->utilisateur->name }}">
                            @else
                                <div class="user-avatar"
                                     style="background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
                                            display: flex; align-items: center; justify-content: center; color: white;
                                            font-weight: 600;">
                                    {{ strtoupper(substr($commentaire->utilisateur->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="user-name">{{ $commentaire->utilisateur->name }}</div>
                                <div class="user-email">{{ $commentaire->utilisateur->email }}</div>
                            </div>
                        </div>
                    </td>

                    <!-- Contenu -->
                    <td>
                        <div class="content-title" title="{{ $commentaire->contenu->titre }}">
                            {{ $commentaire->contenu->titre }}
                        </div>
                    </td>

                    <!-- Note -->
                    <td>
                        <div class="stars-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill' : '' }}"></i>
                            @endfor
                            <div class="text-muted small mt-1">{{ $commentaire->note }}/5</div>
                        </div>
                    </td>

                    <!-- Commentaire -->
                    <td>
                        <div class="comment-text" title="{{ $commentaire->commentaire }}">
                            {{ $commentaire->commentaire }}
                        </div>
                    </td>

                    <!-- Statut -->
                    <td>
                        @if($commentaire->statut == 'pending')
                            <span class="badge-status badge-pending">
                                <i class="bi bi-clock me-1"></i>
                                En attente
                            </span>
                        @elseif($commentaire->statut == 'validated')
                            <span class="badge-status badge-validated">
                                <i class="bi bi-check-circle me-1"></i>
                                Validé
                            </span>
                        @else
                            <span class="badge-status badge-rejected">
                                <i class="bi bi-x-circle me-1"></i>
                                Rejeté
                            </span>
                        @endif
                    </td>

                    <!-- Date -->
                    <td>
                        <div class="fw-medium">{{ $commentaire->created_at->format('d/m/Y') }}</div>
                        <div class="text-muted small">{{ $commentaire->created_at->format('H:i') }}</div>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="action-buttons justify-content-center">
                            <!-- Voir -->
                            <a href="{{ route('admin.commentaires.show', $commentaire->id) }}"
                               class="btn-action btn-view"
                               title="Voir les détails">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Valider -->
                            @if($commentaire->statut !== 'validated')
                            <form action="{{ route('admin.commentaires.valider', $commentaire->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                <button type="submit"
                                        class="btn-action btn-validate"
                                        title="Valider ce commentaire"
                                        onclick="return confirm('Êtes-vous sûr de vouloir valider ce commentaire ?')">
                                    <i class="bi bi-check2"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn-action btn-validate" disabled title="Déjà validé">
                                <i class="bi bi-check2"></i>
                            </button>
                            @endif

                            <!-- Rejeter -->
                            @if($commentaire->statut !== 'rejected')
                            <form action="{{ route('admin.commentaires.rejeter', $commentaire->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                <button type="submit"
                                        class="btn-action btn-reject"
                                        title="Rejeter ce commentaire"
                                        onclick="return confirm('Êtes-vous sûr de vouloir rejeter ce commentaire ?')">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn-action btn-reject" disabled title="Déjà rejeté">
                                <i class="bi bi-x-lg"></i>
                            </button>
                            @endif

                            <!-- Supprimer -->
                            <form action="{{ route('admin.commentaires.destroy', $commentaire->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn-action btn-delete"
                                        title="Supprimer définitivement"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce commentaire ? Cette action est irréversible.')">
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
        <i class="bi bi-chat-x"></i>
        <h4 class="mt-3 mb-2">Aucun commentaire trouvé</h4>
        <p class="text-muted mb-4">Aucun commentaire ne correspond à votre filtre</p>
        <a href="{{ route('admin.commentaires.index') }}" class="btn-filter">
            <i class="bi bi-arrow-clockwise"></i>
            Réinitialiser les filtres
        </a>
    </div>
    @endif
</div>

<!-- Pagination -->
@if($commentaires->hasPages())
<div class="pagination-container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="text-muted mb-3 mb-md-0">
            <i class="bi bi-list-check me-1"></i>
            Affichage de <strong>{{ $commentaires->firstItem() }}</strong> à <strong>{{ $commentaires->lastItem() }}</strong>
            sur <strong>{{ $commentaires->total() }}</strong> commentaires
        </div>
        <div>
            {{ $commentaires->links() }}
        </div>
    </div>
</div>
@endif

<script>
    // Animation pour les lignes du tableau
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.comment-table tbody tr');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            row.classList.add('animate__animated', 'animate__fadeInUp');
        });

        // Afficher le texte complet du commentaire au clic
        document.querySelectorAll('.comment-text').forEach(comment => {
            comment.addEventListener('click', function() {
                const fullText = this.getAttribute('title');
                if (fullText) {
                    alert('Commentaire complet :\n\n' + fullText);
                }
            });
        });
    });
</script>

@endsection
