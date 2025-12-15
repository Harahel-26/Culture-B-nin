@extends('admin.layouts')

@section('title', 'Demandes contributeurs')

@section('content')

<style>
    /* Styles généraux */
    .demands-container {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 20px;
        min-height: 100vh;
    }

    /* En-tête */
    .page-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }

    .page-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2.2rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.4rem;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-top: 10px;
        padding-left: 45px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Filtres */
    .filters-container {
        background: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(30, 27, 75, 0.05);
    }

    .filter-btn {
        padding: 10px 20px;
        border-radius: 10px;
        border: 2px solid rgba(30, 27, 75, 0.1);
        background: white;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .filter-btn:hover,
    .filter-btn.active {
        border-color: #8a2be2;
        background: rgba(138, 43, 226, 0.05);
        color: #1e1b4b;
        font-weight: 600;
    }

    .filter-count {
        background: rgba(30, 27, 75, 0.1);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-left: 5px;
    }

    /* Tableau */
    .demands-table-container {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
    }

    .table-header {
        background: linear-gradient(135deg, #1e1b4b, #3730a3);
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        color: white;
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-title i {
        color: #d4a017;
    }

    .table-stats {
        background: rgba(255, 255, 255, 0.15);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        color: white;
    }

    .table-stats i {
        margin-right: 5px;
    }

    /* Table */
    .demands-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .demands-table thead {
        background: rgba(30, 27, 75, 0.03);
    }

    .demands-table th {
        padding: 18px 20px;
        font-weight: 700;
        color: #1e1b4b;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
    }

    .demands-table td {
        padding: 20px;
        border-bottom: 1px solid rgba(30, 27, 75, 0.05);
        vertical-align: middle;
    }

    .demands-table tbody tr {
        transition: all 0.2s ease;
    }

    .demands-table tbody tr:hover {
        background-color: rgba(138, 43, 226, 0.03);
        transform: translateX(4px);
    }

    /* Informations utilisateur */
    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(138, 43, 226, 0.2);
        flex-shrink: 0;
    }

    .user-details {
        flex: 1;
    }

    .user-name {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .user-email {
        color: #6b7280;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .user-date {
        font-size: 0.85rem;
        color: #9ca3af;
        margin-top: 3px;
    }

    /* Motif */
    .motif-text {
        max-width: 400px;
        line-height: 1.6;
        color: #4b5563;
        font-size: 0.95rem;
        padding: 12px;
        background: rgba(30, 27, 75, 0.02);
        border-radius: 10px;
        border-left: 3px solid #8a2be2;
        margin: 0;
    }

    .motif-empty {
        color: #9ca3af;
        font-style: italic;
        font-size: 0.95rem;
    }

    /* Badges de status */
    .status-badge {
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
    }

    .status-accepted {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }

    .status-rejected {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }

    /* Actions */
    .actions-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-accept {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
    }

    .btn-accept:hover {
        background: linear-gradient(135deg, #34d399, #10b981);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .btn-reject {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
    }

    .btn-reject:hover {
        background: linear-gradient(135deg, #f87171, #ef4444);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
        color: white;
    }

    .btn-view {
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        color: white;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.2);
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #3b82f6, #0ea5e9);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
        color: white;
    }

    .btn-processed {
        padding: 10px 20px;
        border-radius: 10px;
        background: rgba(30, 27, 75, 0.05);
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-processed i {
        color: #10b981;
    }

    /* Pagination */
    .pagination-container {
        background: rgba(30, 27, 75, 0.02);
        padding: 20px;
        border-top: 1px solid rgba(30, 27, 75, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination-info {
        color: #6b7280;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #1e1b4b, #3730a3);
        border-color: #1e1b4b;
        color: white;
    }

    .pagination .page-link {
        color: #1e1b4b;
        border: 1px solid rgba(30, 27, 75, 0.1);
        padding: 8px 16px;
        border-radius: 8px;
        margin: 0 4px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background-color: rgba(30, 27, 75, 0.05);
        border-color: rgba(30, 27, 75, 0.2);
    }

    /* État vide */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 4rem;
        color: #e0e0e0;
        margin-bottom: 20px;
    }

    .empty-title {
        color: #6b7280;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-text {
        color: #9ca3af;
        max-width: 400px;
        margin: 0 auto 30px;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .demands-table {
            display: block;
            overflow-x: auto;
        }

        .actions-container {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .user-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
</style>

<div class="demands-container">
    <!-- En-tête -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-person-badge"></i>
            Demandes de Contribution
        </h1>
        <p class="page-subtitle">
            <i class="bi bi-info-circle"></i>
            Gérez les demandes des utilisateurs souhaitant devenir contributeurs
        </p>
    </div>

    <!-- Filtres -->
    <div class="filters-container">
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('admin.demandes.index') }}"
               class="filter-btn {{ request('status') == null ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                Toutes les demandes
                <span class="filter-count">{{ $totalDemandes ?? $demandes->total() }}</span>
            </a>

            <a href="{{ route('admin.demandes.index', ['status' => 'pending']) }}"
               class="filter-btn {{ request('status') == 'pending' ? 'active' : '' }}">
                <i class="bi bi-clock"></i>
                En attente
                <span class="filter-count">{{ $pendingCount ?? $demandes->where('status', 'pending')->count() }}</span>
            </a>

            <a href="{{ route('admin.demandes.index', ['status' => 'accepted']) }}"
               class="filter-btn {{ request('status') == 'accepted' ? 'active' : '' }}">
                <i class="bi bi-check-circle"></i>
                Acceptées
                <span class="filter-count">{{ $acceptedCount ?? $demandes->where('status', 'accepted')->count() }}</span>
            </a>

            <a href="{{ route('admin.demandes.index', ['status' => 'rejected']) }}"
               class="filter-btn {{ request('status') == 'rejected' ? 'active' : '' }}">
                <i class="bi bi-x-circle"></i>
                Rejetées
                <span class="filter-count">{{ $rejectedCount ?? $demandes->where('status', 'rejected')->count() }}</span>
            </a>
        </div>
    </div>

    <!-- Tableau des demandes -->
    <div class="demands-table-container">
        <div class="table-header">
            <h3 class="table-title">
                <i class="bi bi-list-columns"></i>
                Liste des demandes
            </h3>
            <div class="table-stats">
                <i class="bi bi-people"></i>
                {{ $demandes->total() }} demande(s)
            </div>
        </div>

        @if($demandes->count() > 0)
            <div class="table-responsive">
                <table class="demands-table">
                    <thead>
                        <tr>
                            <th style="width: 250px;">Utilisateur</th>
                            <th style="min-width: 300px;">Motif</th>
                            <th style="width: 140px;">Status</th>
                            <th style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $d)
                        <tr>
                            <!-- Utilisateur -->
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ substr($d->user->name, 0, 1) }}
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name">{{ $d->user->name }}</div>
                                        <div class="user-email">
                                            <i class="bi bi-envelope"></i>
                                            {{ $d->user->email }}
                                        </div>
                                        <div class="user-date">
                                            <i class="bi bi-calendar"></i>
                                            {{ $d->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Motif -->
                            <td>
                                @if($d->motif)
                                    <p class="motif-text">
                                        {{ $d->motif }}
                                    </p>
                                @else
                                    <p class="motif-empty">
                                        <i class="bi bi-dash-circle"></i>
                                        Aucun motif fournie
                                    </p>
                                @endif
                            </td>

                            <!-- Status-->
                            <td>
                                @if($d->status == 'pending')
                                    <span class="status-badge status-pending">
                                        <i class="bi bi-clock"></i>
                                        En attente
                                    </span>
                                @elseif($d->status == 'accepted')
                                    <span class="status-badge status-accepted">
                                        <i class="bi bi-check-circle"></i>
                                        Acceptée
                                    </span>
                                @else
                                    <span class="status-badge status-rejected">
                                        <i class="bi bi-x-circle"></i>
                                        Rejetée
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td>
                                @if($d->status == 'pending')
                                    <div class="actions-container">
                                        <form method="POST" action="{{ route('admin.demandes.accepter', $d) }}"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir accepter cette demande ? L\'utilisateur deviendra contributeur.')"
                                              class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action btn-accept">
                                                <i class="bi bi-check-lg"></i>
                                                Accepter
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.demandes.rejeter', $d) }}"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ? L\'utilisateur ne pourra pas soumettre de contenus.')"
                                              class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action btn-reject">
                                                <i class="bi bi-x-lg"></i>
                                                Rejeter
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="btn-processed">
                                        <i class="bi bi-check2-all"></i>
                                        Demande traitée
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($demandes->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Affichage de {{ $demandes->firstItem() }} à {{ $demandes->lastItem() }} sur {{ $demandes->total() }} demandes
                </div>
                <div>
                    {{ $demandes->links() }}
                </div>
            </div>
            @endif

        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-person-x"></i>
                </div>
                <h3 class="empty-title">Aucune demande trouvée</h3>
                <p class="empty-text">
                    @if(request('status') == 'pending')
                        Aucune demande n'est actuellement en attente de validation.
                    @elseif(request('status') == 'accepted')
                        Aucune demande n'a été acceptée pour le moment.
                    @elseif(request('status') == 'rejected')
                        Aucune demande n'a été rejetée pour le moment.
                    @else
                        Aucune demande de contribution n'a été soumise.
                    @endif
                </p>
                @if(request('status'))
                    <a href="{{ route('admin.demandes.index') }}" class="filter-btn">
                        <i class="bi bi-arrow-clockwise"></i>
                        Voir toutes les demandes
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Scripts -->
<script>
// Confirmation pour les actions
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter des événements de confirmation
    const acceptForms = document.querySelectorAll('form[action*="accepter"]');
    const rejectForms = document.querySelectorAll('form[action*="rejeter"]');

    acceptForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir accepter cette demande ? L\'utilisateur deviendra contributeur et pourra soumettre des contenus.')) {
                e.preventDefault();
            }
        });
    });

    rejectForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir rejeter cette demande ? L\'utilisateur sera notifié et ne pourra pas soumettre de contenus.')) {
                e.preventDefault();
            }
        });
    });

    // Animation au survol des lignes
    const rows = document.querySelectorAll('.demands-table tbody tr');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});
</script>

@endsection
