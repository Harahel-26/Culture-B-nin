@extends('admin.layouts')

@section('title', 'Gestion des traductions')

@section('content')

<style>
    :root {
        --admin-primary: #1e1b4b;
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
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

    .translations-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .translations-table thead th {
        background: var(--admin-light);
        color: var(--admin-dark);
        font-weight: 600;
        padding: 18px 20px;
        border-bottom: 2px solid #e2e8f0;
        text-align: left;
        white-space: nowrap;
    }

    .translations-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .translations-table tbody tr:hover {
        background: rgba(138, 43, 226, 0.03);
    }

    .translations-table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        color: var(--admin-dark);
        border-bottom: 1px solid #f1f5f9;
    }

    .translations-table tbody tr:last-child td {
        border-bottom: none;
    }

    .content-title {
        font-weight: 600;
        color: var(--admin-primary);
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .language-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .language-flag {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(138, 43, 226, 0.2);
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
        justify-content: flex-end;
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

    .btn-validate {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .btn-reject {
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

        .content-title {
            max-width: 150px;
        }
    }
</style>

<!-- En-tête avec statistiques -->
<div class="header-card">
    <div class="mb-4">
        <h1 class="page-title">
            <i class="bi bi-translate"></i>
            Gestion des Traductions
        </h1>
        <p class="page-subtitle">
            Gérez et supervisez les traductions des contenus culturels
        </p>
    </div>

    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon">
                <i class="bi bi-translate"></i>
            </div>
            <div class="stat-number">{{ $stats['total'] ?? 0 }}</div>
            <div class="stat-label">Total des traductions</div>
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
            <div class="stat-label">Validées</div>
        </div>

        <div class="stat-card stat-rejected">
            <div class="stat-icon">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-number">{{ $stats['rejected'] ?? 0 }}</div>
            <div class="stat-label">Rejetées</div>
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
                    <select name="status" class="form-select filter-select" style="min-width: 220px;">
                        <option value="">Tous les statuts</option>
                        <option value="pending" @selected(request('status')=='pending')>En attente</option>
                        <option value="validated" @selected(request('status')=='validated')>Validées</option>
                        <option value="rejected" @selected(request('status')=='rejected')>Rejetées</option>
                    </select>
                </div>

                <button type="submit" class="btn-filter">
                    <i class="bi bi-sliders"></i>
                    Appliquer le filtre
                </button>

                @if(request('status'))
                    <a href="{{ route('admin.traductions.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i>
                        Réinitialiser
                    </a>
                @endif
            </form>
        </div>

        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                {{ $traductions->total() }} traduction(s) trouvée(s)
            </div>
        </div>
    </div>
</div>

<!-- Tableau des traductions -->
<div class="table-container">
    <div class="table-header">
        <h3>
            <i class="bi bi-list-ul"></i>
            Liste des traductions
        </h3>
    </div>

    @if($traductions->count() > 0)
    <div class="table-responsive">
        <table class="translations-table">
            <thead>
                <tr>
                    <th>Contenu</th>
                    <th>Langue</th>
                    <th>Traducteur</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($traductions as $t)
                <tr>
                    <td>
                        <div class="content-title" title="{{ $t->contenu->titre ?? '—' }}">
                            {{ $t->contenu->titre ?? '—' }}
                        </div>
                        @if($t->titre)
                        <div class="text-muted small mt-1">
                            <i class="bi bi-arrow-right me-1"></i>
                            {{ Str::limit($t->titre, 50) }}
                        </div>
                        @endif
                    </td>

                    <td>
                        <div class="language-info">
                            @if($t->langue->flag_url ?? false)
                                <img src="{{ $t->langue->flag_url }}"
                                     class="language-flag"
                                     alt="{{ $t->langue->nom }}">
                            @endif
                            <div>
                                <div>{{ $t->langue->nom ?? '—' }}</div>
                                <div class="text-muted small">{{ $t->langue->code ?? '' }}</div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="user-info">
                            @if($t->traducteur->avatar_url ?? false)
                                <img src="{{ $t->traducteur->avatar_url }}"
                                     class="user-avatar"
                                     alt="{{ $t->traducteur->name }}">
                            @endif
                            <div>
                                <div class="fw-medium">{{ $t->traducteur->name ?? '—' }}</div>
                                @if($t->traducteur->email ?? false)
                                <div class="text-muted small">{{ $t->traducteur->email }}</div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($t->status == 'pending')
                            <span class="badge-status badge-pending">
                                <i class="bi bi-clock me-1"></i>
                                En attente
                            </span>
                        @elseif($t->status == 'validated')
                            <span class="badge-status badge-validated">
                                <i class="bi bi-check-circle me-1"></i>
                                Validée
                            </span>
                        @else
                            <span class="badge-status badge-rejected">
                                <i class="bi bi-x-circle me-1"></i>
                                Rejetée
                            </span>
                        @endif
                    </td>

                    <td>
                        <div class="fw-medium">{{ $t->created_at->format('d/m/Y') }}</div>
                        <div class="text-muted small">{{ $t->created_at->format('H:i') }}</div>
                    </td>

                    <td>
                        <div class="action-buttons">
                            <!-- Voir -->
                            <a href="{{ route('admin.traductions.show', $t) }}"
                               class="btn-action btn-view"
                               title="Voir détails">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Modifier (uniquement pour le traducteur) -->
                            @if($t->traduit_par == auth()->id())
                                <a href="{{ route('admin.traductions.edit', $t) }}"
                                   class="btn-action btn-edit"
                                   title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endif

                            <!-- Valider (admin/modérateur seulement) -->
                            @if(auth()->user()->hasRole(['admin','moderateur']) && $t->status != 'validated')
                                <form action="{{ route('admin.traductions.valider', $t) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Valider cette traduction ?')">
                                    @csrf @method('PUT')
                                    <button type="submit"
                                            class="btn-action btn-validate"
                                            title="Valider">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>
                            @endif

                            <!-- Rejeter (admin/modérateur seulement) -->
                            @if(auth()->user()->hasRole(['admin','moderateur']) && $t->status != 'rejected')
                                <form action="{{ route('admin.traductions.rejeter', $t) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Rejeter cette traduction ?')">
                                    @csrf @method('PUT')
                                    <button type="submit"
                                            class="btn-action btn-reject"
                                            title="Rejeter">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="no-data">
        <i class="bi bi-translate"></i>
        <h4 class="mt-3 mb-2">Aucune traduction trouvée</h4>
        <p class="text-muted mb-4">Aucune traduction ne correspond à votre filtre</p>
        @if(request('status'))
            <a href="{{ route('admin.traductions.index') }}" class="btn-filter">
                <i class="bi bi-arrow-clockwise"></i>
                Réinitialiser les filtres
            </a>
        @endif
    </div>
    @endif
</div>

<!-- Pagination -->
@if($traductions->hasPages())
<div class="pagination-container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="text-muted mb-3 mb-md-0">
            <i class="bi bi-list-check me-1"></i>
            Affichage de <strong>{{ $traductions->firstItem() }}</strong> à <strong>{{ $traductions->lastItem() }}</strong>
            sur <strong>{{ $traductions->total() }}</strong> traductions
        </div>
        <div>
            {{ $traductions->links() }}
        </div>
    </div>
</div>
@endif

<script>
    // Confirmation pour les actions de validation/rejet
    document.addEventListener('DOMContentLoaded', function() {
        // Animation pour les lignes du tableau
        const rows = document.querySelectorAll('.translations-table tbody tr');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            row.classList.add('animate__animated', 'animate__fadeInUp');
        });
    });
</script>

@endsection
