{{-- filepath: resources/views/admin/dashboards/index.blade.php --}}
@extends('admin.layouts')

@section('page-title', 'Tableau de bord')
@section('breadcrumb')
    <li class="breadcrumb-item active">Tableau de bord</li>
@endsection

@section('content')
<style>
    /* Styles généraux */
    .dashboard-container {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 100vh;
        padding: 20px;
    }

    /* En-tête */
    .dashboard-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }

    .dashboard-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2.4rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .dashboard-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.6rem;
    }

    .dashboard-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-top: 10px;
        padding-left: 45px;
    }

    /* Cartes de statistiques principales */
    .stat-card {
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .stat-card-primary::before { background: linear-gradient(to right, #8a2be2, #1e1b4b); }
    .stat-card-success::before { background: linear-gradient(to right, #10b981, #34d399); }
    .stat-card-warning::before { background: linear-gradient(to right, #f59e0b, #fbbf24); }
    .stat-card-info::before { background: linear-gradient(to right, #0ea5e9, #3b82f6); }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .stat-number {
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1;
        margin: 10px 0;
        color: #1e1b4b;
    }

    .stat-label {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1e1b4b;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-subtext {
        color: #6b7280;
        font-size: 0.95rem;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Graphiques */
    .chart-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        height: 100%;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .chart-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e1b4b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-title i {
        color: #8a2be2;
    }

    /* Cartes secondaires */
    .mini-stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(30, 27, 75, 0.05);
        text-align: center;
        transition: all 0.3s ease;
    }

    .mini-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .mini-stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e1b4b;
        margin: 10px 0;
    }

    .mini-stat-label {
        font-weight: 600;
        color: #6b7280;
        font-size: 0.95rem;
    }

    .mini-stat-icon {
        font-size: 1.8rem;
        color: #8a2be2;
        margin-bottom: 10px;
    }

    /* Tableaux récents */
    .recent-card {
        background: white;
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        overflow: hidden;
    }

    .recent-header {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.05), rgba(138, 43, 226, 0.05));
        padding: 20px 25px;
        border-bottom: 1px solid rgba(30, 27, 75, 0.1);
    }

    .recent-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e1b4b;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .recent-title i {
        color: #8a2be2;
    }

    .recent-body {
        padding: 25px;
    }

    /* Tableaux */
    .recent-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .recent-table thead {
        background: rgba(30, 27, 75, 0.03);
    }

    .recent-table th {
        padding: 15px 20px;
        font-weight: 700;
        color: #1e1b4b;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .recent-table td {
        padding: 15px 20px;
        border-bottom: 1px solid rgba(30, 27, 75, 0.05);
        color: #4b5563;
        vertical-align: middle;
    }

    .recent-table tbody tr {
        transition: all 0.2s ease;
    }

    .recent-table tbody tr:hover {
        background-color: rgba(138, 43, 226, 0.03);
    }

    /* Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-success {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
    }

    .badge-danger {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }

    .badge-info {
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        color: white;
    }

    /* État vide */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #9ca3af;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #e0e0e0;
    }

    .empty-text {
        font-size: 1.1rem;
        margin: 0;
    }

    /* Indicateurs de tendance */
    .trend-indicator {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 12px;
        margin-left: 10px;
    }

    .trend-up {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .trend-down {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .trend-neutral {
        background: rgba(156, 163, 175, 0.1);
        color: #6b7280;
    }

    /* Widgets de progression */
    .progress-widget {
        margin-top: 15px;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .progress-bar {
        height: 8px;
        background: rgba(30, 27, 75, 0.1);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 4px;
        background: linear-gradient(to right, #8a2be2, #1e1b4b);
    }

    /* Filtres de période */
    .period-filter {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .period-btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: 2px solid rgba(30, 27, 75, 0.1);
        background: white;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .period-btn:hover,
    .period-btn.active {
        border-color: #8a2be2;
        background: rgba(138, 43, 226, 0.05);
        color: #1e1b4b;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }

        .stat-number {
            font-size: 2.2rem;
        }

        .chart-card {
            padding: 15px;
        }
    }
</style>

<div class="dashboard-container">
    <!-- En-tête -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="bi bi-speedometer2"></i>
            Tableau de Bord Administratif
        </h1>
        <p class="dashboard-subtitle">
            <i class="bi bi-calendar-check"></i>
            Aujourd'hui : {{ now()->format('d/m/Y') }} • Dernière mise à jour : {{ now()->format('H:i') }}
        </p>
    </div>

    <!-- Filtres de période -->
    <div class="period-filter">
        <button class="period-btn active" data-period="today">Aujourd'hui</button>
        <button class="period-btn" data-period="week">Cette semaine</button>
        <button class="period-btn" data-period="month">Ce mois</button>
        <button class="period-btn" data-period="year">Cette année</button>
    </div>

    <!-- Statistiques principales -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-label">
                    <i class="bi bi-journal-text"></i>
                    Contenus
                </div>
                <div class="stat-number">
                    {{ $stats['contenus']['total'] ?? $stats['contenus_total'] }}
                </div>
                <div class="progress-widget">
                    <div class="progress-label">
                        <span>Validés</span>
                        <span>{{ $stats['contenus']['valides'] ?? $stats['contenus_valides'] }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ ($stats['contenus']['valides'] ?? $stats['contenus_valides']) / ($stats['contenus']['total'] ?? $stats['contenus_total']) * 100 }}%"></div>
                    </div>
                </div>
                <div class="stat-subtext">
                    <i class="bi bi-clock"></i>
                    {{ $stats['contenus']['en_attente'] ?? $stats['contenus_attente'] }} en attente
                    <span class="trend-indicator trend-up">
                        <i class="bi bi-arrow-up"></i>
                        12%
                    </span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="stat-card stat-card-success">
                <div class="stat-label">
                    <i class="bi bi-people"></i>
                    Utilisateurs
                </div>
                <div class="stat-number">
                    {{ $stats['users']['total'] ?? $stats['users_total'] }}
                </div>
                <div class="progress-widget">
                    <div class="progress-label">
                        <span>Contributeurs</span>
                        <span>{{ $stats['users']['contributeurs'] ?? $stats['users_contributeurs'] }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ ($stats['users']['contributeurs'] ?? $stats['users_contributeurs']) / ($stats['users']['total'] ?? $stats['users_total']) * 100 }}%"></div>
                    </div>
                </div>
                <div class="stat-subtext">
                    <i class="bi bi-shield-check"></i>
                    {{ $stats['users']['admins'] ?? $stats['users_admins'] }} administrateurs
                    <span class="trend-indicator trend-up">
                        <i class="bi bi-arrow-up"></i>
                        8%
                    </span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-label">
                    <i class="bi bi-chat-dots"></i>
                    Commentaires
                </div>
                <div class="stat-number">
                    {{ $stats['commentaires']['total'] ?? ($stats['commentaires_total'] ?? 0) }}
                </div>
                <div class="progress-widget">
                    <div class="progress-label">
                        <span>Approuvés</span>
                        <span>{{ ($stats['commentaires']['total'] ?? ($stats['commentaires_total'] ?? 0)) - ($stats['commentaires']['en_attente'] ?? ($stats['commentaires_attente'] ?? 0)) }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ (($stats['commentaires']['total'] ?? ($stats['commentaires_total'] ?? 0)) - ($stats['commentaires']['en_attente'] ?? ($stats['commentaires_attente'] ?? 0))) / ($stats['commentaires']['total'] ?? ($stats['commentaires_total'] ?? 1)) * 100 }}%"></div>
                    </div>
                </div>
                <div class="stat-subtext">
                    <i class="bi bi-clock-history"></i>
                    {{ $stats['commentaires']['en_attente'] ?? ($stats['commentaires_attente'] ?? 0) }} en attente
                    <span class="trend-indicator trend-neutral">
                        <i class="bi bi-dash"></i>
                        0%
                    </span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="stat-card stat-card-info">
                <div class="stat-label">
                    <i class="bi bi-cash-stack"></i>
                    Revenus
                </div>
                <div class="stat-number">
                    {{ number_format($paiements['montant_total'] ?? 0, 0, ',', ' ') }}<small style="font-size: 1.5rem;"> FCFA</small>
                </div>
                <div class="progress-widget">
                    <div class="progress-label">
                        <span>Paiements</span>
                        <span>{{ $paiements['total'] ?? 0 }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $paiements['total'] ?? 0 > 0 ? '100' : '0' }}%"></div>
                    </div>
                </div>
                <div class="stat-subtext">
                    <i class="bi bi-graph-up-arrow"></i>
                    {{ $paiements['recent_count'] ?? 0 }} nouveaux ce mois
                    <span class="trend-indicator trend-up">
                        <i class="bi bi-arrow-up"></i>
                        15%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques secondaires -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="mini-stat-card">
                <div class="mini-stat-icon">
                    <i class="bi bi-gem"></i>
                </div>
                <div class="mini-stat-number">
                    {{ $stats['contenus_premium'] ?? 0 }}
                </div>
                <div class="mini-stat-label">
                    Contenus Premium
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="mini-stat-card">
                <div class="mini-stat-icon">
                    <i class="bi bi-eye"></i>
                </div>
                <div class="mini-stat-number">
                    {{ $stats['vues_total'] ?? 0 }}
                </div>
                <div class="mini-stat-label">
                    Vues Total
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="mini-stat-card">
                <div class="mini-stat-icon">
                    <i class="bi bi-heart"></i>
                </div>
                <div class="mini-stat-number">
                    {{ $stats['likes_total'] ?? 0 }}
                </div>
                <div class="mini-stat-label">
                    J'aime Total
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="mini-stat-card">
                <div class="mini-stat-icon">
                    <i class="bi bi-star"></i>
                </div>
                <div class="mini-stat-number">
                    {{ $stats['moyenne_notes'] ?? '0.0' }}/5
                </div>
                <div class="mini-stat-label">
                    Note Moyenne
                </div>
            </div>
        </div>
    </div>



    <!-- Tableaux récents -->
    <div class="row g-4 mb-4">
        <!-- Paiements récents -->
        <div class="col-lg-6">
            <div class="recent-card">
                <div class="recent-header">
                    <h3 class="recent-title">
                        <i class="bi bi-credit-card"></i>
                        Paiements récents
                    </h3>
                </div>
                <div class="recent-body">
                    @if(isset($paiements['recent']) && count($paiements['recent']) > 0)
                        <div class="table-responsive">
                            <table class="recent-table">
                                <thead>
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paiements['recent'] as $p)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #8a2be2, #1e1b4b); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                                                    {{ substr($p->user->name ?? 'U', 0, 1) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: #1e1b4b;">{{ $p->user->name ?? 'Utilisateur' }}</div>
                                                    <div style="font-size: 0.85rem; color: #9ca3af;">{{ $p->user->email ?? '' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="font-weight: 700; color: #10b981;">
                                            {{ number_format($p->montant, 0, ',', ' ') }} FCFA
                                        </td>
                                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="status-badge badge-success">
                                                <i class="bi bi-check-circle"></i>
                                                Payé
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-credit-card-2-front"></i>
                            </div>
                            <p class="empty-text">Aucun paiement récent</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contenus récents -->
        <div class="col-lg-6">
            <div class="recent-card">
                <div class="recent-header">
                    <h3 class="recent-title">
                        <i class="bi bi-journal-plus"></i>
                        Contenus récents
                    </h3>
                </div>
                <div class="recent-body">
                    @if(isset($contenusRecents) && $contenusRecents->count() > 0)
                        <div class="table-responsive">
                            <table class="recent-table">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contenusRecents as $contenu)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                @if($contenu->image_couverture)
                                                    <img src="{{ asset('storage/'.$contenu->image_couverture) }}"
                                                         style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;">
                                                @endif
                                                <div>
                                                    <div style="font-weight: 600; color: #1e1b4b;">{{ Str::limit($contenu->titre, 30) }}</div>
                                                    <div style="font-size: 0.85rem; color: #9ca3af;">
                                                        {{ $contenu->auteur->name ?? 'N/A' }} • {{ $contenu->langue->nom ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($contenu->status == 'validated')
                                                <span class="status-badge badge-success">
                                                    <i class="bi bi-check-circle"></i>
                                                    Validé
                                                </span>
                                            @elseif($contenu->status == 'pending')
                                                <span class="status-badge badge-warning">
                                                    <i class="bi bi-clock"></i>
                                                    En attente
                                                </span>
                                            @elseif($contenu->status == 'draft')
                                                <span class="status-badge badge-info">
                                                    <i class="bi bi-pencil"></i>
                                                    Brouillon
                                                </span>
                                            @else
                                                <span class="status-badge badge-danger">
                                                    <i class="bi bi-x-circle"></i>
                                                    Rejeté
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $contenu->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-journal-x"></i>
                            </div>
                            <p class="empty-text">Aucun contenu récent</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Commentaires récents -->
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="recent-card">
                <div class="recent-header">
                    <h3 class="recent-title">
                        <i class="bi bi-chat-left-text"></i>
                        Commentaires récents
                    </h3>
                </div>
                <div class="recent-body">
                    @if(isset($commentairesRecents) && $commentairesRecents->count() > 0)
                        <div class="table-responsive">
                            <table class="recent-table">
                                <thead>
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Commentaire</th>
                                        <th>Contenu</th>
                                        <th>Date</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commentairesRecents as $com)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #8a2be2, #1e1b4b); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                                                    {{ substr($com->utilisateur->name ?? 'U', 0, 1) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: #1e1b4b;">{{ $com->utilisateur->name ?? '' }}</div>
                                                    <div style="font-size: 0.85rem; color: #9ca3af;">{{ $com->utilisateur->email ?? '' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                {{ $com->commentaire }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 600; color: #1e1b4b;">
                                                {{ Str::limit($com->contenu->titre ?? '', 25) }}
                                            </div>
                                        </td>
                                        <td>{{ $com->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 2px; color: #f59e0b;">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star{{ $i <= $com->note ? '-fill' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-chat-left"></i>
                            </div>
                            <p class="empty-text">Aucun commentaire récent</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Filtres de période
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            // Ici, vous pourriez ajouter une logique pour filtrer les données
        });
    });

    // Graphique des contenus par mois
    const contenusMoisCtx = document.getElementById('chartContenusMois').getContext('2d');
    new Chart(contenusMoisCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Contenus publiés',
                data: {!! json_encode(array_values($contenus_mois)) !!},
                borderColor: '#8a2be2',
                backgroundColor: 'rgba(138, 43, 226, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#1e1b4b',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(30, 27, 75, 0.05)'
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(30, 27, 75, 0.05)'
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            }
        }
    });

    // Graphique des langues
    const languesCtx = document.getElementById('chartLangues').getContext('2d');
    new Chart(languesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($langues_plus->pluck('langue.nom')->toArray()) !!},
            datasets: [{
                label: 'Nombre de contenus',
                data: {!! json_encode($langues_plus->pluck('total')->toArray()) !!},
                backgroundColor: [
                    'rgba(138, 43, 226, 0.8)',
                    'rgba(30, 27, 75, 0.8)',
                    'rgba(212, 160, 23, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderColor: [
                    '#8a2be2',
                    '#1e1b4b',
                    '#d4a017',
                    '#10b981',
                    '#3b82f6'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(30, 27, 75, 0.05)'
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            }
        }
    });

    // Graphique des types de contenu
    const typesCtx = document.getElementById('chartTypes').getContext('2d');
    new Chart(typesCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($types_plus->pluck('typecontenu.nom')->toArray()) !!},
            datasets: [{
                data: {!! json_encode($types_plus->pluck('total')->toArray()) !!},
                backgroundColor: [
                    'rgba(138, 43, 226, 0.8)',
                    'rgba(30, 27, 75, 0.8)',
                    'rgba(212, 160, 23, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderColor: [
                    '#8a2be2',
                    '#1e1b4b',
                    '#d4a017',
                    '#10b981',
                    '#3b82f6'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#6b7280',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            },
            cutout: '60%'
        }
    });

    // Graphique des rôles utilisateurs
    const rolesCtx = document.getElementById('chartRoles').getContext('2d');
    new Chart(rolesCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($users_roles->pluck('role_name')->toArray()) !!},
            datasets: [{
                data: {!! json_encode($users_roles->pluck('total')->toArray()) !!},
                backgroundColor: [
                    'rgba(138, 43, 226, 0.8)',
                    'rgba(30, 27, 75, 0.8)',
                    'rgba(212, 160, 23, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderColor: [
                    '#8a2be2',
                    '#1e1b4b',
                    '#d4a017',
                    '#10b981',
                    '#3b82f6'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#6b7280',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
@endsection
