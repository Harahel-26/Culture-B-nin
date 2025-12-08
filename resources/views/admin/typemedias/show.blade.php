@extends('admin.layouts')

@section('title', 'Détails Type Média')

@section('content')

<style>
    .detail-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        position: relative;
        overflow: hidden;
    }
    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, #8a2be2, #1e1b4b);
    }
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
    .btn-back {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-back:hover {
        background: #f8f9fa;
        border-color: #9ca3af;
        color: #374151;
    }
    .type-header {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(30, 27, 75, 0.05));
        padding: 25px;
        border-radius: 14px;
        margin-bottom: 25px;
        text-align: center;
        border: 2px solid rgba(138, 43, 226, 0.1);
    }
    .type-icon {
        font-size: 3.5rem;
        color: #8a2be2;
        margin-bottom: 15px;
    }
    .type-name {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e1b4b;
        margin-bottom: 10px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 25px;
    }
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid rgba(30, 27, 75, 0.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e1b4b;
        margin-bottom: 8px;
    }
    .stat-label {
        color: #6b7280;
        font-weight: 600;
        font-size: 0.95rem;
    }
</style>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-folder"></i>
        Détails du Type de Média
    </h1>
    
    <a href="{{ route('admin.typemedias.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
        Retour à la liste
    </a>
</div>

<div class="detail-card">
    <!-- En-tête -->
    <div class="type-header">
        <div class="type-icon">
            <i class="bi bi-{{ $typemedia->nom === 'image' ? 'image' : ($typemedia->nom === 'video' ? 'camera-video' : 'music-note-beamed') }}-fill"></i>
        </div>
        <div class="type-name">{{ ucfirst($typemedia->nom) }}</div>
    </div>

    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $typemedia->medias->count() }}</div>
            <div class="stat-label">Médias associés</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">
                @php
                    $validatedMedia = $typemedia->medias->where('status', 'validated')->count();
                @endphp
                {{ $validatedMedia }}
            </div>
            <div class="stat-label">Médias validés</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">
                @php
                    $pendingMedia = $typemedia->medias->where('status', 'pending')->count();
                @endphp
                {{ $pendingMedia }}
            </div>
            <div class="stat-label">Médias en attente</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">
                {{ $typemedia->id }}
            </div>
            <div class="stat-label">ID du type</div>
        </div>
    </div>

    <!-- Informations -->
    <div class="mt-4 pt-4 border-top">
        <h5 class="fw-bold mb-3" style="color: #1e1b4b;">
            <i class="bi bi-info-circle"></i>
            Informations
        </h5>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="fw-bold text-muted mb-1">Nom du type</div>
                <div class="fw-medium">{{ $typemedia->nom }}</div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="fw-bold text-muted mb-1">Créé le</div>
                <div class="fw-medium">{{ $typemedia->created_at->format('d/m/Y à H:i') }}</div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="fw-bold text-muted mb-1">Dernière modification</div>
                <div class="fw-medium">{{ $typemedia->updated_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>
    </div>
</div>

@endsection