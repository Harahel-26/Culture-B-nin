@extends('front.layouts.app')

@section('title', 'Espace Contributeur')

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
    }

    .dashboard-header {
        background: linear-gradient(135deg, var(--primary), #2d3748);
        color: white;
        padding: 2.5rem 0;
        margin: -2rem -2rem 2rem -2rem;
        border-radius: 0 0 20px 20px;
    }

    .stats-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .stats-card.total::before {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .stats-card.pending::before {
        background: linear-gradient(90deg, var(--warning), #fbbf24);
    }

    .stats-card.validated::before {
        background: linear-gradient(90deg, var(--success), #34d399);
    }

    .stats-card.rejected::before {
        background: linear-gradient(90deg, var(--danger), #f87171);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .icon-total {
        background: rgba(30, 43, 77, 0.1);
        color: var(--primary);
    }

    .icon-pending {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .icon-validated {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .icon-rejected {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.5rem;
        font-variant-numeric: tabular-nums;
    }

    .stat-label {
        color: #6b7280;
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .stat-change {
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .change-up {
        color: var(--success);
    }

    .change-down {
        color: var(--danger);
    }

    .btn-create-content {
        background: linear-gradient(135deg, var(--accent), #c40909);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .btn-create-content:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(165, 42, 42, 0.3);
        color: white;
    }

    .btn-create-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }

    .btn-create-content:hover::before {
        left: 100%;
    }

    .quick-actions {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .action-card {
        text-align: center;
        padding: 1.5rem;
        border-radius: 12px;
        background: #f8fafc;
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }

    .action-card:hover {
        background: white;
        border-color: var(--secondary);
        transform: translateY(-5px);
    }

    .action-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--secondary), #f5c842);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: var(--primary);
        font-size: 2rem;
    }

    .recent-activity {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .icon-created {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .icon-updated {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .icon-validated {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
    }

    .activity-content h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .activity-time {
        font-size: 0.85rem;
        color: #6b7280;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .badge-pending {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .badge-validated {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-rejected {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem 0;
            margin: -1rem -1rem 1rem -1rem;
        }

        .stat-number {
            font-size: 2rem;
        }
    }
</style>

<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-3" style="font-size: 2.5rem;">
                    <i class="bi bi-pencil-square me-3"></i>
                    Espace Contributeur
                </h1>
                <p class="fs-5 opacity-90 mb-0">
                    Gérer vos contenus, suivre vos statistiques et contribuer à la richesse culturelle
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('contributeur.contenus.create') }}"
                   class="btn btn-create-content">
                    <i class="bi bi-plus-circle"></i>
                    Nouveau contenu
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    {{-- STATISTIQUES --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card total">
                <div class="p-4">
                    <div class="stats-icon icon-total">
                        <i class="bi bi-collection"></i>
                    </div>
                    <div class="stat-number">{{ $total_contenus }}</div>
                    <h5 class="stat-label">Total des contenus</h5>
                    <div class="stat-change change-up">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>+12% ce mois</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card pending">
                <div class="p-4">
                    <div class="stats-icon icon-pending">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-number">{{ $en_attente }}</div>
                    <h5 class="stat-label">En attente</h5>
                    <div class="stat-change change-up">
                        <i class="bi bi-arrow-up-right"></i>
                        <span>{{ $en_attente > 0 ? 'À modérer' : 'Aucun en attente' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card validated">
                <div class="p-4">
                    <div class="stats-icon icon-validated">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $valides }}</div>
                    <h5 class="stat-label">Validés</h5>
                    <div class="stat-change change-up">
                        <i class="bi bi-check-lg"></i>
                        <span>{{ number_format($valides/$total_contenus*100, 0) }}% de taux</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card rejected">
                <div class="p-4">
                    <div class="stats-icon icon-rejected">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="stat-number">{{ $rejetes }}</div>
                    <h5 class="stat-label">Rejetés</h5>
                    <div class="stat-change change-down">
                        <i class="bi bi-arrow-down-right"></i>
                        <span>{{ $rejetes > 0 ? 'À réviser' : 'Aucun rejet' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ACTIONS RAPIDES --}}
    <div class="quick-actions">
        <h3 class="fw-bold mb-4" style="color: var(--primary);">
            <i class="bi bi-lightning-charge me-2"></i>
            Actions rapides
        </h3>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('contributeur.contenus.create') }}" class="text-decoration-none">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Nouveau contenu</h5>
                        <p class="text-muted small mb-0">
                            Créez et soumettez un nouveau contenu culturel
                        </p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('contributeur.contenus.index') }}" class="text-decoration-none">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Gérer mes contenus</h5>
                        <p class="text-muted small mb-0">
                            Visualiser, modifier ou supprimer vos contenus
                        </p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Statistiques</h5>
                        <p class="text-muted small mb-0">
                            Consultez les performances de vos contenus
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Dans la section ACTIVITÉ RÉCENTE --}}
<div class="recent-activity">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: var(--primary);">
            <i class="bi bi-clock-history me-2"></i>
            Activité récente
        </h3>
        <a href="{{ route('contributeur.contenus.index') }}" class="card-link" style="color: var(--accent);">
            Voir tout <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="activity-list">
        @forelse($recent_activities as $activity)
        <div class="activity-item">
            <div class="activity-icon icon-{{ $activity['type'] }}">
                @if($activity['type'] == 'created')
                    <i class="bi bi-plus-lg"></i>
                @elseif($activity['type'] == 'updated')
                    <i class="bi bi-pencil"></i>
                @else
                    <i class="bi bi-check-lg"></i>
                @endif
            </div>

            <div class="activity-content flex-grow-1">
                <h6 class="mb-1">{{ $activity['title'] }}</h6>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="activity-time">
                        <i class="bi bi-clock me-1"></i>
                        {{ $activity['time'] }}
                    </span>
                    <span class="status-badge badge-{{ $activity['status'] }}">
                        @if($activity['status'] == 'pending')
                            <i class="bi bi-clock-history"></i> En attente
                        @elseif($activity['status'] == 'validated')
                            <i class="bi bi-check-circle"></i> Validé
                        @elseif($activity['status'] == 'rejected')
                            <i class="bi bi-x-circle"></i> Rejeté
                        @else
                            <i class="bi bi-question-circle"></i> {{ $activity['status'] }}
                        @endif
                    </span>
                </div>
                @if(isset($activity['contenu']->typecontenu))
                <small class="text-muted d-block mt-1">
                    <i class="bi bi-tag me-1"></i>
                    {{ $activity['contenu']->typecontenu->nom }}
                </small>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-4">
            <i class="bi bi-inbox" style="font-size: 3rem; color: #d1d5db;"></i>
            <p class="text-muted mt-3">Aucune activité récente</p>
            <a href="{{ route('contributeur.contenus.create') }}" class="btn btn-sm"
               style="background: var(--accent); color: white;">
                Créer votre premier contenu
            </a>
        </div>
        @endforelse
    </div>
</div>

    {{-- TIPS & GUIDES --}}
    <div class="row g-4 mt-4">
        <div class="col-lg-8">
            <div class="quick-actions">
                <h5 class="fw-bold mb-3" style="color: var(--primary);">
                    <i class="bi bi-lightbulb me-2"></i>
                    Conseils pour de meilleurs contenus
                </h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill me-2 mt-1" style="color: var(--success);"></i>
                        <span>Ajoutez toujours des images de haute qualité</span>
                    </li>
                    <li class="mb-2 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill me-2 mt-1" style="color: var(--success);"></i>
                        <span>Citez vos sources et références</span>
                    </li>
                    <li class="mb-2 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill me-2 mt-1" style="color: var(--success);"></i>
                        <span>Vérifiez l'exactitude des informations historiques</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill me-2 mt-1" style="color: var(--success);"></i>
                        <span>Respectez les droits d'auteur et les permissions</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="quick-actions h-90 d-flex flex-column justify-content-center">
                <h5 class="fw-bold mb-3" style="color: var(--primary);">
                    <i class="bi bi-award me-2"></i>
                    Votre statut
                </h5>
                <div class="text-center">
                    <div class="mb-3">
                        <i class="bi bi-shield-check" style="font-size: 3rem; color: var(--secondary);"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Contributeur Actif</h4>
                    <p class="text-muted small mb-0">
                        {{ $total_contenus }} contenus publiés
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation pour les compteurs
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            const duration = 1500;
            const increment = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current);
            }, 16);
        });
    });
</script>
@endsection
