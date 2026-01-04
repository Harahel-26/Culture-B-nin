@extends('front.layouts.app')

@section('title', 'Mes contenus')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5 position-relative">
        <div class="hero-content" style="z-index: 2;">
            <h1 class="fw-bold text-white mb-3" style="font-size: 2.8rem; font-family: 'Playfair Display', serif;">
                Gérer vos contenus
            </h1>
            <p class="text-light fs-5 opacity-90" style="max-width: 600px; margin: 0 auto;">
                Visualisez, modifiez et suivez tous vos contenus soumis à la plateforme
            </p>
        </div>
    </div>
</section>
@endsection

@section('content')
<style>
    :root {
        --primary: #1E2B4D;
        --secondary: #E8C676;
        --accent: #A52A2A;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --light-bg: #f8fafc;
        --border: #e2e8f0;
        --card-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .dashboard-header {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .filter-tab {
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        background: var(--light-bg);
        border: 2px solid transparent;
        color: var(--primary);
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-tab:hover,
    .filter-tab.active {
        background: var(--secondary);
        color: var(--primary);
        border-color: var(--secondary);
    }

    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card.total {
        border-top: 4px solid var(--primary);
    }

    .stat-card.pending {
        border-top: 4px solid var(--warning);
    }

    .stat-card.validated {
        border-top: 4px solid var(--success);
    }

    .stat-card.rejected {
        border-top: 4px solid var(--danger);
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .contenu-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        border: 1px solid var(--border);
    }

    .contenu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        border-color: var(--secondary);
    }

    .card-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .contenu-card:hover .card-image {
        transform: scale(1.05);
    }

    .card-status {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }

    .status-badge {
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .badge-validated {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .badge-pending {
        background: rgba(245, 158, 11, 0.15);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .badge-rejected {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .badge-draft {
        background: rgba(100, 116, 139, 0.15);
        color: #64748b;
        border: 1px solid rgba(100, 116, 139, 0.3);
    }

    .card-content {
        padding: 1.5rem;
    }

    .card-title {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-meta {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 1rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .meta-item i {
        color: var(--secondary);
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .action-view {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .action-edit {
        background: rgba(232, 198, 118, 0.1);
        color: var(--secondary);
        border: 1px solid rgba(232, 198, 118, 0.2);
    }

    .action-delete {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .action-view:hover {
        background: var(--info);
        color: white;
    }

    .action-edit:hover {
        background: var(--secondary);
        color: var(--primary);
    }

    .action-delete:hover {
        background: var(--danger);
        color: white;
    }

    .card-date {
        font-size: 0.8rem;
        color: #94a3b8;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    .btn-create {
        background: linear-gradient(135deg, var(--accent), #dc2626);
        color: white;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(165, 42, 42, 0.3);
        color: white;
    }

    .pagination-container {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
    }

    .pagination .page-link {
        color: var(--primary);
        border: 2px solid var(--border);
        margin: 0 0.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .pagination .page-item.active .page-link {
        background: var(--secondary);
        border-color: var(--secondary);
        color: var(--primary);
    }

    .pagination .page-link:hover {
        background: var(--light-bg);
        border-color: var(--secondary);
    }

    .view-toggle {
        display: flex;
        gap: 0.5rem;
        margin-left: auto;
    }

    .view-btn {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--light-bg);
        color: var(--primary);
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .view-btn.active {
        background: var(--secondary);
        border-color: var(--secondary);
    }

    .view-btn:hover {
        border-color: var(--secondary);
    }

    .grid-view {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .table-view {
        display: none;
    }

    .table-view.active {
        display: block;
    }

    .grid-view.active {
        display: grid;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
        }

        .stats-overview {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-view {
            grid-template-columns: 1fr;
        }

        .filter-tabs {
            justify-content: center;
        }
    }
</style>

<div class="container">
    <!-- En-tête du dashboard -->
    <div class="dashboard-header">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-2" style="color: var(--primary);">
                    <i class="bi bi-collection me-2"></i>
                    Gestion des contenus
                </h2>
                <p class="text-muted mb-0">
                    Vous avez {{ $contenus->total() }} contenu{{ $contenus->total() > 1 ? 's' : '' }} au total
                </p>
            </div>

            <div class="d-flex gap-2">
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid" title="Vue grille">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </button>
                    <button class="view-btn" data-view="table" title="Vue tableau">
                        <i class="bi bi-list-task"></i>
                    </button>
                </div>

                <a href="{{ route('contributeur.contenus.create') }}" class="btn-create">
                    <i class="bi bi-plus-circle"></i>
                    Nouveau contenu
                </a>
            </div>
        </div>

        <!-- Statistiques rapides -->
        @php
            $stats = [
                'total' => $contenus->total(),
                'pending' => $contenus->where('status', 'pending')->count(),
                'validated' => $contenus->where('status', 'validated')->count(),
                'rejected' => $contenus->where('status', 'rejected')->count(),
            ];
        @endphp

        <div class="stats-overview">
            <div class="stat-card total">
                <div class="stat-number">{{ $stats['total'] }}</div>
                <div class="stat-label">Total des contenus</div>
            </div>

            <div class="stat-card pending">
                <div class="stat-number">{{ $stats['pending'] }}</div>
                <div class="stat-label">En attente</div>
            </div>

            <div class="stat-card validated">
                <div class="stat-number">{{ $stats['validated'] }}</div>
                <div class="stat-label">Validés</div>
            </div>

            <div class="stat-card rejected">
                <div class="stat-number">{{ $stats['rejected'] }}</div>
                <div class="stat-label">Rejetés</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filter-tabs">
            <a href="{{ route('contributeur.contenus.index') }}"
               class="filter-tab {{ !request('status') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                Tous ({{ $stats['total'] }})
            </a>
            <a href="{{ route('contributeur.contenus.index', ['status' => 'pending']) }}"
               class="filter-tab {{ request('status') == 'pending' ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                En attente ({{ $stats['pending'] }})
            </a>
            <a href="{{ route('contributeur.contenus.index', ['status' => 'validated']) }}"
               class="filter-tab {{ request('status') == 'validated' ? 'active' : '' }}">
                <i class="bi bi-check-circle"></i>
                Validés ({{ $stats['validated'] }})
            </a>
            <a href="{{ route('contributeur.contenus.index', ['status' => 'rejected']) }}"
               class="filter-tab {{ request('status') == 'rejected' ? 'active' : '' }}">
                <i class="bi bi-x-circle"></i>
                Rejetés ({{ $stats['rejected'] }})
            </a>
        </div>
    </div>

    @if($contenus->isEmpty())
        <!-- État vide -->
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <h3 class="fw-bold mb-3" style="color: var(--primary);">
                Aucun contenu trouvé
            </h3>
            <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">
                Vous n'avez pas encore créé de contenu. Commencez par partager vos connaissances culturelles !
            </p>
            <a href="{{ route('contributeur.contenus.create') }}" class="btn-create">
                <i class="bi bi-plus-circle"></i>
                Créer mon premier contenu
            </a>
        </div>
    @else
        <!-- Vue grille (par défaut) -->
        <div class="grid-view active" id="gridView">
            <div class="grid-view">
                @foreach($contenus as $contenu)
                <div class="contenu-card">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}"
                             class="card-image"
                             alt="{{ $contenu->titre }}">

                        <div class="card-status">
                            <span class="status-badge badge-{{ $contenu->status }}">
                                @if($contenu->status == 'validated')
                                    <i class="bi bi-check-circle"></i> Validé
                                @elseif($contenu->status == 'pending')
                                    <i class="bi bi-clock-history"></i> En attente
                                @elseif($contenu->status == 'rejected')
                                    <i class="bi bi-x-circle"></i> Rejeté
                                @else
                                    <i class="bi bi-file-earmark"></i> {{ ucfirst($contenu->status) }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">{{ $contenu->titre }}</h3>

                        <div class="card-meta">
                            <span class="meta-item">
                                <i class="bi bi-tag"></i>
                                {{ $contenu->typecontenu->nom }}
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-translate"></i>
                                {{ $contenu->langue->nom }}
                            </span>
                            @if($contenu->is_premium)
                            <span class="meta-item">
                                <i class="bi bi-star-fill" style="color: var(--secondary);"></i>
                                Premium
                            </span>
                            @endif
                        </div>

                        <div class="card-footer">
                            <div class="card-actions">
                                <a href="{{ route('contributeur.contenus.show', $contenu) }}"
                                   class="action-btn action-view" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('contributeur.contenus.edit', $contenu) }}"
                                   class="action-btn action-edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('contributeur.contenus.destroy', $contenu) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Supprimer ce contenu ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-delete" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="card-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $contenu->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Vue tableau (cachée par défaut) -->
        <div class="table-view" id="tableView">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background: var(--light-bg);">
                        <tr>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Langue</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contenus as $contenu)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}"
                                         alt="{{ $contenu->titre }}"
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    <span class="fw-medium">{{ Str::limit($contenu->titre, 40) }}</span>
                                </div>
                            </td>
                            <td>{{ $contenu->typecontenu->nom }}</td>
                            <td>{{ $contenu->langue->nom }}</td>
                            <td>
                                <span class="status-badge badge-{{ $contenu->status }}">
                                    @if($contenu->status == 'validated')
                                        <i class="bi bi-check-circle"></i> Validé
                                    @elseif($contenu->status == 'pending')
                                        <i class="bi bi-clock-history"></i> En attente
                                    @elseif($contenu->status == 'rejected')
                                        <i class="bi bi-x-circle"></i> Rejeté
                                    @endif
                                </span>
                            </td>
                            <td>{{ $contenu->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('contributeur.contenus.show', $contenu) }}"
                                       class="action-btn action-view" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('contributeur.contenus.edit', $contenu) }}"
                                       class="action-btn action-edit" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('contributeur.contenus.destroy', $contenu) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Supprimer ce contenu ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn action-delete" title="Supprimer">
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
        </div>

        <!-- Pagination -->
        @if($contenus->hasPages())
        <div class="pagination-container">
            {{ $contenus->withQueryString()->links() }}
        </div>
        @endif
    @endif
</div>

<script>
    // Toggle entre vue grille et tableau
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;

            // Mettre à jour les boutons actifs
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Afficher la vue correspondante
            document.getElementById('gridView').classList.remove('active');
            document.getElementById('tableView').classList.remove('active');

            if (view === 'grid') {
                document.getElementById('gridView').classList.add('active');
            } else {
                document.getElementById('tableView').classList.add('active');
            }
        });
    });

    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.contenu-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Sauvegarder la préférence de vue
    const savedView = localStorage.getItem('contentView');
    if (savedView) {
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        document.querySelector(`[data-view="${savedView}"]`).classList.add('active');

        document.getElementById('gridView').classList.remove('active');
        document.getElementById('tableView').classList.remove('active');
        document.getElementById(savedView + 'View').classList.add('active');
    }

    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            localStorage.setItem('contentView', this.dataset.view);
        });
    });
</script>
@endsection
