@extends('admin.layouts')

@section('title', 'Gestion des contenus')

@section('content')

<style>
    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
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
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.4rem;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 1rem;
        margin-top: 5px;
        padding-left: 45px;
    }

    /* Bouton d'action */
    .btn-new-content {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 6px 20px rgba(138, 43, 226, 0.2);
    }

    .btn-new-content:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(138, 43, 226, 0.3);
        color: white;
    }

    /* Tableau */
    .content-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        background: white;
    }

    .table-header {
        background: linear-gradient(135deg, #1e1b4b, #3730a3);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
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

    .content-count {
        background: rgba(255, 255, 255, 0.15);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Table */
    .table thead {
        background: rgba(30, 27, 75, 0.03);
    }

    .table thead th {
        border: none;
        padding: 18px 20px;
        font-weight: 700;
        color: #1e1b4b;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
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
        padding: 18px 20px;
        vertical-align: middle;
        border: none;
        color: #4b5563;
    }

    /* Couverture */
    .cover-thumb {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .cover-thumb:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    /* Badges */
    .badge-premium {
        background: linear-gradient(135deg, #d4a017, #f59e0b);
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 3px 8px rgba(212, 160, 23, 0.2);
    }

    .badge-free {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-status {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-width: 100px;
        justify-content: center;
        text-transform: uppercase;
    }

    .draft {
        background: linear-gradient(135deg, #6b7280, #9ca3af);
        color: white;
    }

    .pending {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
    }

    .validated {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }

    .rejected {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
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
        margin: 0 3px;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-view {
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }

    /* Titre du contenu */
    .content-title {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.1rem;
        margin-bottom: 5px;
        display: block;
    }

    .content-title:hover {
        color: #8a2be2;
        text-decoration: underline;
    }

    .content-meta {
        font-size: 0.85rem;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .content-meta i {
        font-size: 0.9rem;
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

    /* Auteur */
    .author-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .author-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .author-details {
        display: flex;
        flex-direction: column;
    }

    .author-name {
        font-weight: 600;
        color: #1e1b4b;
        font-size: 0.95rem;
    }

    .author-email {
        font-size: 0.8rem;
        color: #9ca3af;
    }

    /* Filtres rapides */
    .quick-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: 2px solid rgba(30, 27, 75, 0.1);
        background: white;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .filter-btn:hover, .filter-btn.active {
        border-color: #8a2be2;
        background: rgba(138, 43, 226, 0.05);
        color: #1e1b4b;
    }

    .filter-btn.active {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.1), rgba(30, 27, 75, 0.05));
        font-weight: 600;
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
    }
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">
            <i class="bi bi-journal-text-fill"></i>
            Gestion des Contenus
        </h1>
        <p class="page-subtitle">
            <i class="bi bi-info-circle"></i>
            Gérez et organisez les contenus culturels du Bénin
        </p>
    </div>
    
    <a href="{{ route('admin.contenus.create') }}" class="btn btn-new-content">
        <i class="bi bi-plus-circle-fill"></i>
        Nouveau contenu
    </a>
</div>

<!-- Filtres rapides -->
<div class="quick-filters">
    <a href="{{ route('admin.contenus.index') }}" 
       class="filter-btn {{ request('filter') == null ? 'active' : '' }}">
        <i class="bi bi-grid"></i>
        Tous les contenus
        <span class="badge bg-secondary ms-1">{{ $contenus->total() }}</span>
    </a>
    
    <a href="{{ route('admin.contenus.index', ['filter' => 'premium']) }}" 
       class="filter-btn {{ request('filter') == 'premium' ? 'active' : '' }}">
        <i class="bi bi-gem"></i>
        Premium
        <span class="badge bg-warning ms-1">{{ $premiumCount ?? '' }}</span>
    </a>
    
    <a href="{{ route('admin.contenus.index', ['filter' => 'gratuit']) }}" 
       class="filter-btn {{ request('filter') == 'gratuit' ? 'active' : '' }}">
        <i class="bi bi-unlock"></i>
        Gratuits
    </a>
    
    <a href="{{ route('admin.contenus.index', ['filter' => 'validated']) }}" 
       class="filter-btn {{ request('filter') == 'validated' ? 'active' : '' }}">
        <i class="bi bi-check-circle"></i>
        Validés
    </a>
    
    <a href="{{ route('admin.contenus.index', ['filter' => 'pending']) }}" 
       class="filter-btn {{ request('filter') == 'pending' ? 'active' : '' }}">
        <i class="bi bi-clock"></i>
        En attente
    </a>
</div>

<!-- Tableau des contenus -->
<div class="content-table">
    <div class="table-header">
        <h3 class="table-title">
            <i class="bi bi-list-columns"></i>
            Liste des contenus
        </h3>
        <div class="content-count">
            <i class="bi bi-file-text"></i>
            {{ $contenus->total() }} contenu(s)
        </div>
    </div>

    @if($contenus->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 90px;">Couverture</th>
                    <th style="min-width: 250px;">Contenu</th>
                    <th style="width: 100px;">Langue</th>
                    <th style="width: 120px;">Type</th>
                    <th style="width: 120px;">Accès</th>
                    <th style="width: 130px;">Statut</th>
                    <th style="width: 180px;">Auteur</th>
                    <th style="width: 140px;" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($contenus as $c)
                <tr>

                    <!-- Couverture -->
                    <td>
                        <img src="{{ $c->image_couverture ? asset('storage/'.$c->image_couverture) : asset('images/default-cover.jpg') }}"
                            class="cover-thumb"
                            alt="Couverture de {{ $c->titre }}"
                            title="{{ $c->titre }}">
                    </td>

                    <!-- Titre et informations -->
                    <td>
                        <a href="{{ route('admin.contenus.show', $c) }}" class="content-title">
                            {{ $c->titre }}
                        </a>
                        <div class="content-meta">
                            <span>
                                <i class="bi bi-calendar"></i>
                                {{ $c->created_at->format('d/m/Y') }}
                            </span>
                            @if($c->region)
                            <span>
                                <i class="bi bi-geo-alt"></i>
                                {{ $c->region->nom }}
                            </span>
                            @endif
                        </div>
                    </td>

                    <!-- Langue -->
                    <td>
                        <span class="fw-medium">{{ $c->langue->nom }}</span>
                        @if($c->langue->code == 'fr')
                            <div class="flag-icon" style="font-size: 1.2rem;">🇫🇷</div>
                        @elseif($c->langue->code == 'en')
                            <div class="flag-icon" style="font-size: 1.2rem;">🇬🇧</div>
                        @endif
                    </td>

                    <!-- Type -->
                    <td>
                        <span class="fw-medium">{{ $c->typecontenu->nom }}</span>
                    </td>

                    <!-- Premium/Gratuit -->
                    <td>
                        @if($c->is_premium)
                            <span class="badge-premium">
                                <i class="bi bi-gem"></i>
                                Premium
                                @if($c->prix)
                                    <span class="ms-1">{{ number_format($c->prix, 0, ',', ' ') }} FCFA</span>
                                @endif
                            </span>
                        @else
                            <span class="badge-free">
                                <i class="bi bi-unlock"></i>
                                Gratuit
                            </span>
                        @endif
                    </td>

                    <!-- Statut -->
                    <td>
                        <span class="badge-status {{ $c->status }}">
                            @if($c->status == 'draft')
                                <i class="bi bi-file-earmark"></i>
                            @elseif($c->status == 'pending')
                                <i class="bi bi-clock"></i>
                            @elseif($c->status == 'validated')
                                <i class="bi bi-check-circle"></i>
                            @elseif($c->status == 'rejected')
                                <i class="bi bi-x-circle"></i>
                            @endif
                            {{ ucfirst($c->status) }}
                        </span>
                    </td>

                    <!-- Auteur -->
                    <td>
                        <div class="author-info">
                            <div class="author-avatar">
                                {{ substr($c->utilisateur->name, 0, 1) }}
                            </div>
                            <div class="author-details">
                                <span class="author-name">{{ $c->utilisateur->name }}</span>
                                <span class="author-email">{{ $c->utilisateur->email }}</span>
                            </div>
                        </div>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.contenus.show', $c) }}"
                               class="btn btn-action btn-view"
                               title="Voir le contenu">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.contenus.edit', $c) }}"
                               class="btn btn-action btn-edit"
                               title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.contenus.destroy', $c) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-action btn-delete"
                                        title="Supprimer"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.')">
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

    <!-- Pagination -->
    @if($contenus->hasPages())
    <div class="pagination-container">
        <div class="pagination-info">
            Affichage de {{ $contenus->firstItem() }} à {{ $contenus->lastItem() }} sur {{ $contenus->total() }} contenus
        </div>
        <div>
            {{ $contenus->links() }}
        </div>
    </div>
    @endif

    @else
    <!-- État vide -->
    <div class="empty-state">
        <div class="empty-icon">
            <i class="bi bi-journal-x"></i>
        </div>
        <h3 class="empty-title">Aucun contenu trouvé</h3>
        <p class="empty-text">
            Aucun contenu ne correspond à vos critères. Commencez par créer votre premier contenu culturel.
        </p>
        <a href="{{ route('admin.contenus.create') }}" class="btn btn-new-content">
            <i class="bi bi-plus-circle-fill"></i>
            Créer mon premier contenu
        </a>
    </div>
    @endif
</div>

@endsection