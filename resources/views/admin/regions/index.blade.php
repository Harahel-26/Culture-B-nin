@extends('admin.layouts')

@section('title', 'Gestion des Régions')

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
    .btn-new {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    .btn-new:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-2px);
        color: white;
    }
    .alert-success {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        border: 2px solid #10b981;
        color: #065f46;
        border-radius: 12px;
        padding: 16px;
        font-weight: 600;
        margin-bottom: 25px;
    }
    .table-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
    }
    .table-header {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.03), rgba(138, 43, 226, 0.03));
        padding: 20px 25px;
        border-bottom: 1px solid rgba(30, 27, 75, 0.1);
    }
    .table-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e1b4b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .table-title i {
        color: #8a2be2;
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
    .region-name {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.1rem;
    }
    .region-description {
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 5px;
    }
    .badge-type {
        background: rgba(30, 27, 75, 0.1);
        color: #1e1b4b;
        padding: 8px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .badge-langue {
        background: rgba(212, 160, 23, 0.1);
        color: #d4a017;
        padding: 8px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
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
    .badge-active {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }
    .badge-inactive {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        font-size: 1rem;
        margin-right: 6px;
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
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .pagination-container {
        background: rgba(30, 27, 75, 0.02);
        padding: 20px;
        border-top: 1px solid rgba(30, 27, 75, 0.05);
    }
</style>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-geo-alt"></i>
        Régions du Bénin
    </h1>
    
    <a href="{{ route('admin.regions.create') }}" class="btn-new">
        <i class="bi bi-plus-circle"></i>
        Nouvelle Région
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
    <div class="table-header">
        <h3 class="table-title">
            <i class="bi bi-list-columns"></i>
            Liste des régions
        </h3>
    </div>

    @if($regions->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Langue principale</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $region)
                    <tr>
                        <td>
                            <div class="region-name">{{ $region->nom }}</div>
                            @if($region->description)
                                <div class="region-description">
                                    {{ Str::limit($region->description, 50) }}
                                </div>
                            @endif
                        </td>
                        
                        <td>
                            <span class="badge-type">
                                <i class="bi bi-tag"></i>
                                {{ $region->type ?? 'Non défini' }}
                            </span>
                        </td>
                        
                        <td>
                            @if($region->languePrincipale)
                                <span class="badge-langue">
                                    <i class="bi bi-translate"></i>
                                    {{ $region->languePrincipale->nom }}
                                </span>
                            @else
                                <span class="text-muted">Aucune</span>
                            @endif
                        </td>
                        
                        <td>
                            @if($region->is_active)
                                <span class="badge-status badge-active">
                                    <i class="bi bi-check-circle"></i>
                                    Active
                                </span>
                            @else
                                <span class="badge-status badge-inactive">
                                    <i class="bi bi-x-circle"></i>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        
                        <td class="text-end">
                            <a href="{{ route('admin.regions.show', $region) }}"
                               class="btn-action btn-view"
                               title="Voir détails">
                                <i class="bi bi-eye"></i>
                            </a>
                            
                            <a href="{{ route('admin.regions.edit', $region) }}"
                               class="btn-action btn-edit"
                               title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            <form action="{{ route('admin.regions.destroy', $region) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Supprimer cette région ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn-action btn-delete"
                                        title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($regions->hasPages())
            <div class="pagination-container">
                {{ $regions->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-geo-alt" style="font-size: 3rem; color: #e0e0e0;"></i>
            </div>
            <h4 style="color: #6b7280;">Aucune région enregistrée</h4>
            <p class="text-muted mb-4">Commencez par ajouter votre première région</p>
            <a href="{{ route('admin.regions.create') }}" class="btn-new">
                <i class="bi bi-plus-circle"></i>
                Ajouter une région
            </a>
        </div>
    @endif
</div>

@endsection