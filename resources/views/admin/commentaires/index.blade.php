@extends('admin.layouts')

@section('title', 'Gestion des commentaires')

@section('content')

<style>
    /* Cartes de statistiques améliorées */
    .stat-card {
        background: linear-gradient(135deg, #1e1b4b, #3730a3);
        color: #fff;
        border-radius: 14px;
        padding: 22px 15px;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(30, 27, 75, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, #8a2be2, #d4a017);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(30, 27, 75, 0.2);
    }

    .stat-card span {
        font-size: 2.2rem;
        font-weight: 800;
        color: #d4a017;
        display: block;
        margin: 8px 0;
        text-shadow: 0 2px 4px rgba(212, 160, 23, 0.3);
    }

    .stat-card small {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 500;
    }

    /* Badges de statut améliorés */
    .status-badge {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        min-width: 100px;
        text-align: center;
        display: inline-block;
    }

    .pending {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .validated {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border: 1px solid #b1dfbb;
    }

    .rejected {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Tableau amélioré */
    .table-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
    }

    .table thead {
        background: linear-gradient(135deg, #1e1b4b, #3730a3);
        color: white;
    }

    .table thead th {
        border: none;
        padding: 18px 16px;
        font-weight: 700;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(30, 27, 75, 0.05);
    }

    .table tbody tr:hover {
        background-color: rgba(138, 43, 226, 0.03);
        transform: translateX(4px);
    }

    .table tbody td {
        padding: 16px;
        vertical-align: middle;
        border: none;
    }

    /* Commentaire avec effet */
    .comment-text {
        max-width: 300px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .comment-text:hover {
        color: #1e1b4b;
        font-weight: 500;
    }

    .comment-text::after {
        content: '...';
        position: absolute;
        right: 0;
        background: linear-gradient(to right, transparent, white);
        padding-left: 10px;
    }

    /* Étoiles de notation */
    .stars-container {
        font-size: 1.1rem;
        letter-spacing: 2px;
    }

    .bi-star-fill {
        color: #FFC107;
        text-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
    }

    .bi-star {
        color: #e0e0e0;
    }

    /* Boutons d'action */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        font-size: 1rem;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-view {
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        color: white;
    }

    .btn-validate {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }

    .btn-reject {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }

    /* Filtres */
    .filter-card {
        background: white;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(30, 27, 75, 0.1);
    }

    .filter-select {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 10px 15px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
        outline: none;
    }

    .btn-filter {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-filter:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(138, 43, 226, 0.2);
    }

    /* En-tête */
    .header-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2.2rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.4rem;
    }

    .header-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 600px;
    }

    /* Pagination */
    .pagination-container {
        background: rgba(30, 27, 75, 0.02);
        padding: 20px;
        border-top: 1px solid rgba(30, 27, 75, 0.05);
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
    }

    .pagination .page-link:hover {
        background-color: rgba(30, 27, 75, 0.05);
    }

    /* Avatar utilisateur */
    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        margin-right: 10px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }
</style>

<div class="mb-5">
    <h1 class="header-title">
        <i class="bi bi-chat-text-fill"></i>
        Gestion des Commentaires
    </h1>
    <p class="header-subtitle">
        Modérez et gérez les avis des visiteurs sur les contenus culturels du Bénin
    </p>
</div>

<!-- STATISTIQUES -->
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <small>TOTAL DES COMMENTAIRES</small>
            <span>{{ $stats['total'] }}</span>
            <small><i class="bi bi-chat-dots"></i> Tous les avis</small>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <small>EN ATTENTE</small>
            <span>{{ $stats['pending'] }}</span>
            <small><i class="bi bi-clock"></i> À modérer</small>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <small>VALIDÉS</small>
            <span>{{ $stats['validated'] }}</span>
            <small><i class="bi bi-check-circle"></i> Approuvés</small>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <small>REJETÉS</small>
            <span>{{ $stats['rejected'] }}</span>
            <small><i class="bi bi-x-circle"></i> Non publiés</small>
        </div>
    </div>
</div>

<!-- FILTRES -->
<div class="filter-card mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <form method="GET" class="d-flex gap-3 align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-funnel" style="color: #8a2be2; font-size: 1.2rem;"></i>
                    <select name="statut" class="form-select filter-select" style="max-width: 220px;">
                        <option value="">Tous les statuts</option>
                        <option value="pending" @selected(request('statut')=='pending')>En attente</option>
                        <option value="validated" @selected(request('statut')=='validated')>Validés</option>
                        <option value="rejected" @selected(request('statut')=='rejected')>Rejetés</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-filter">
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
                <i class="bi bi-info-circle"></i>
                {{ $commentaires->total() }} résultat(s) trouvé(s)
            </div>
        </div>
    </div>
</div>

<!-- TABLEAU DES COMMENTAIRES -->
<div class="table-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 200px;">Auteur</th>
                    <th style="width: 200px;">Contenu</th>
                    <th style="width: 120px;">Note</th>
                    <th>Commentaire</th>
                    <th style="width: 120px;">Statut</th>
                    <th style="width: 120px;">Date</th>
                    <th style="width: 180px;" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($commentaires as $commentaire)
                <tr>

                    <!-- Auteur -->
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ substr($commentaire->utilisateur->name, 0, 1) }}
                            </div>
                            <div>
                                <strong class="d-block">{{ $commentaire->utilisateur->name }}</strong>
                                <small class="text-muted d-block">{{ $commentaire->utilisateur->email }}</small>
                            </div>
                        </div>
                    </td>

                    <!-- Contenu -->
                    <td>
                        <div class="fw-bold text-truncate" style="max-width: 180px;"
                             title="{{ $commentaire->contenu->titre }}">
                            {{ $commentaire->contenu->titre }}
                        </div>
                    </td>

                    <!-- Note -->
                    <td>
                        <div class="stars-container">
                            @for($i=1; $i<=5; $i++)
                                <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill' : '' }}"></i>
                            @endfor
                            <small class="d-block text-muted mt-1">{{ $commentaire->note }}/5</small>
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
                        <span class="status-badge {{ $commentaire->statut }}">
                            @if($commentaire->statut == 'pending')
                                <i class="bi bi-clock me-1"></i>
                            @elseif($commentaire->statut == 'validated')
                                <i class="bi bi-check-circle me-1"></i>
                            @else
                                <i class="bi bi-x-circle me-1"></i>
                            @endif
                            {{ $commentaire->statut }}
                        </span>
                    </td>

                    <!-- Date -->
                    <td>
                        <div class="fw-medium">{{ $commentaire->created_at->format('d/m/Y') }}</div>
                        <small class="text-muted">{{ $commentaire->created_at->format('H:i') }}</small>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Voir -->
                            <a href="{{ route('admin.commentaires.show', $commentaire->id) }}"
                               class="btn btn-action btn-view"
                               title="Voir les détails">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Valider -->
                            @if($commentaire->statut !== 'validated')
                            <form action="{{ route('admin.commentaires.valider', $commentaire->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-action btn-validate"
                                        title="Valider ce commentaire"
                                        onclick="return confirm('Valider ce commentaire ?')">
                                    <i class="bi bi-check2"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn btn-action btn-validate" disabled title="Déjà validé">
                                <i class="bi bi-check2"></i>
                            </button>
                            @endif

                            <!-- Rejeter -->
                            @if($commentaire->statut !== 'rejected')
                            <form action="{{ route('admin.commentaires.rejeter', $commentaire->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-action btn-reject"
                                        title="Rejeter ce commentaire"
                                        onclick="return confirm('Rejeter ce commentaire ?')">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn btn-action btn-reject" disabled title="Déjà rejeté">
                                <i class="bi bi-x-lg"></i>
                            </button>
                            @endif

                            <!-- Supprimer -->
                            <form action="{{ route('admin.commentaires.destroy', $commentaire->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-action btn-delete"
                                        title="Supprimer définitivement"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce commentaire ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="py-4">
                            <i class="bi bi-chat-x" style="font-size: 3rem; color: #e0e0e0;"></i>
                            <h5 class="mt-3 mb-2" style="color: #6b7280;">Aucun commentaire trouvé</h5>
                            <p class="text-muted">Aucun commentaire ne correspond à votre filtre</p>
                            <a href="{{ route('admin.commentaires.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-clockwise"></i>
                                Réinitialiser les filtres
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($commentaires->hasPages())
    <div class="pagination-container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
                Affichage de {{ $commentaires->firstItem() }} à {{ $commentaires->lastItem() }} sur {{ $commentaires->total() }} commentaires
            </div>
            <div>
                {{ $commentaires->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
