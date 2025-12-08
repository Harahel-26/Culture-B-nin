@extends('admin.layouts')

@section('title', 'Paiements')

@section('content')

<style>
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
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .page-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }
    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(30, 27, 75, 0.12);
    }
    .stat-card-primary {
        border-top: 4px solid #8a2be2;
    }
    .stat-card-success {
        border-top: 4px solid #10b981;
    }
    .stat-card-warning {
        border-top: 4px solid #f59e0b;
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e1b4b;
        margin: 10px 0;
    }
    .stat-label {
        font-weight: 600;
        color: #6b7280;
        font-size: 0.95rem;
    }
    .filters-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(30, 27, 75, 0.05);
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
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.1);
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
    }
    .table-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
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
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .table-title i {
        color: #d4a017;
    }
    .table {
        margin: 0;
    }
    .table thead th {
        border: none;
        padding: 18px 20px;
        font-weight: 700;
        color: #1e1b4b;
        background: rgba(30, 27, 75, 0.03);
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }
    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(30, 27, 75, 0.05);
    }
    .table tbody tr:hover {
        background: rgba(138, 43, 226, 0.03);
    }
    .table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border: none;
    }
    .badge-status {
        padding: 8px 14px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-paye {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }
    .status-en_attente {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
    }
    .status-echec {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }
    .status-annule {
        background: linear-gradient(135deg, #6b7280, #9ca3af);
        color: white;
    }
    .badge-method {
        background: rgba(30, 27, 75, 0.1);
        color: #1e1b4b;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-view {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(14, 165, 233, 0.2);
    }
    .pagination-container {
        background: rgba(30, 27, 75, 0.02);
        padding: 20px;
        border-top: 1px solid rgba(30, 27, 75, 0.05);
    }
</style>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-credit-card"></i>
        Paiements
    </h1>
</div>

<!-- Statistiques -->
<div class="stats-grid">
    <div class="stat-card stat-card-primary">
        <div class="stat-label">Total paiements</div>
        <div class="stat-number">{{ $stats['total'] }}</div>
    </div>
    
    <div class="stat-card stat-card-success">
        <div class="stat-label">Total payé</div>
        <div class="stat-number">{{ number_format($stats['paye'],0,',',' ') }}<small style="font-size: 1rem;"> FCFA</small></div>
    </div>
    
    <div class="stat-card stat-card-warning">
        <div class="stat-label">En attente</div>
        <div class="stat-number">{{ $stats['en_attente'] }}</div>
    </div>
</div>

<!-- Filtres -->
<div class="filters-card">
    <form method="GET" class="row g-3 align-items-center">
        <div class="col-md-4">
            <select name="statut" class="form-select filter-select w-100">
                <option value="">Tous les statuts</option>
                <option value="paye" @selected(request('statut') == 'paye')>Payé</option>
                <option value="en_attente" @selected(request('statut') == 'en_attente')>En attente</option>
                <option value="echec" @selected(request('statut') == 'echec')>Échec</option>
            </select>
        </div>
        
        <div class="col-md-4">
            <select name="methode" class="form-select filter-select w-100">
                <option value="">Toutes les méthodes</option>
                <option value="mobile_money" @selected(request('methode') == 'mobile_money')>Mobile Money</option>
                <option value="carte" @selected(request('methode') == 'carte')>Carte bancaire</option>
            </select>
        </div>
        
        <div class="col-md-4">
            <button type="submit" class="btn-filter w-100">
                <i class="bi bi-funnel"></i>
                Appliquer les filtres
            </button>
        </div>
    </form>
</div>

<!-- Tableau -->
<div class="table-card">
    <div class="table-header">
        <h3 class="table-title">
            <i class="bi bi-list-columns"></i>
            Liste des paiements
        </h3>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Utilisateur</th>
                    <th>Contenu</th>
                    <th>Montant</th>
                    <th>Méthode</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($paiements as $p)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $p->reference }}</div>
                    </td>
                    
                    <td>
                        <div class="fw-medium">{{ $p->user->name }}</div>
                        <small class="text-muted">{{ $p->user->email }}</small>
                    </td>
                    
                    <td>
                        <div class="fw-medium">{{ Str::limit($p->contenu->titre, 30) }}</div>
                    </td>
                    
                    <td>
                        <div class="fw-bold" style="color: #10b981;">
                            {{ number_format($p->montant,0,',',' ') }} FCFA
                        </div>
                    </td>
                    
                    <td>
                        <span class="badge-method">
                            <i class="bi bi-{{ $p->methode == 'mobile_money' ? 'phone' : 'credit-card' }}"></i>
                            {{ ucfirst($p->methode) }}
                        </span>
                    </td>
                    
                    <td>
                        <span class="badge-status status-{{ $p->statut }}">
                            @if($p->statut == 'paye')
                                <i class="bi bi-check-circle"></i>
                            @elseif($p->statut == 'en_attente')
                                <i class="bi bi-clock"></i>
                            @elseif($p->statut == 'echec')
                                <i class="bi bi-x-circle"></i>
                            @else
                                <i class="bi bi-slash-circle"></i>
                            @endif
                            {{ ucfirst($p->statut) }}
                        </span>
                    </td>
                    
                    <td>
                        <div>{{ $p->created_at->format('d/m/Y') }}</div>
                        <small class="text-muted">{{ $p->created_at->format('H:i') }}</small>
                    </td>
                    
                    <td>
                        <a href="{{ route('admin.paiements.show', $p) }}"
                           class="btn-view"
                           title="Voir détails">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($paiements->hasPages())
        <div class="pagination-container">
            {{ $paiements->links() }}
        </div>
    @endif
</div>

@endsection