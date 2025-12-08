@extends('admin.layouts')

@section('title', 'Détail du paiement')

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
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .info-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #8a2be2;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .info-label {
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-label i {
        color: #8a2be2;
    }
    .info-value {
        font-size: 1.1rem;
        color: #4b5563;
        font-weight: 600;
    }
    .amount-highlight {
        font-size: 1.8rem;
        color: #10b981;
        font-weight: 800;
    }
    .badge-status {
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
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
    .user-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(14, 165, 233, 0.05));
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border: 1px solid rgba(59, 130, 246, 0.1);
    }
    .content-card {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(30, 27, 75, 0.05));
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border: 1px solid rgba(138, 43, 226, 0.1);
    }
    .metadata-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid rgba(30, 27, 75, 0.1);
        margin-top: 20px;
        max-height: 300px;
        overflow-y: auto;
    }
    .metadata-pre {
        background: #f8fafc;
        padding: 15px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        margin: 0;
    }
</style>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-receipt"></i>
        Détails du paiement
    </h1>
    
    <a href="{{ route('admin.paiements.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
        Retour à la liste
    </a>
</div>

<div class="detail-card">
    <!-- Informations générales -->
    <h5 class="fw-bold mb-4" style="color: #1e1b4b; font-size: 1.3rem;">
        <i class="bi bi-info-circle"></i>
        Informations générales
    </h5>
    
    <div class="info-grid">
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-hash"></i>
                Référence
            </div>
            <div class="info-value">{{ $paiement->reference }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-toggle-on"></i>
                Statut
            </div>
            <div>
                <span class="badge-status status-{{ $paiement->statut }}">
                    @if($paiement->statut == 'paye')
                        <i class="bi bi-check-circle"></i>
                    @elseif($paiement->statut == 'en_attente')
                        <i class="bi bi-clock"></i>
                    @else
                        <i class="bi bi-x-circle"></i>
                    @endif
                    {{ ucfirst($paiement->statut) }}
                </span>
            </div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-credit-card"></i>
                Méthode de paiement
            </div>
            <div class="info-value">{{ ucfirst($paiement->methode) }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-cash-stack"></i>
                Montant
            </div>
            <div class="amount-highlight">{{ number_format($paiement->montant,0,',',' ') }} FCFA</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-calendar"></i>
                Date du paiement
            </div>
            <div class="info-value">{{ $paiement->created_at->format('d/m/Y à H:i') }}</div>
        </div>
    </div>

    <!-- Utilisateur -->
    <h5 class="fw-bold mb-4 mt-5" style="color: #1e1b4b; font-size: 1.3rem;">
        <i class="bi bi-person"></i>
        Utilisateur
    </h5>
    
    <div class="user-card">
        <div class="info-label">
            <i class="bi bi-person-circle"></i>
            Informations utilisateur
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-value mb-2">{{ $paiement->user->name }}</div>
                <small class="text-muted">{{ $paiement->user->email }}</small>
            </div>
            <div class="col-md-6">
                <small class="text-muted">Inscrit le {{ $paiement->user->created_at->format('d/m/Y') }}</small>
            </div>
        </div>
    </div>

    <!-- Contenu acheté -->
    <h5 class="fw-bold mb-4 mt-5" style="color: #1e1b4b; font-size: 1.3rem;">
        <i class="bi bi-journal-text"></i>
        Contenu acheté
    </h5>
    
    <div class="content-card">
        <div class="info-label">
            <i class="bi bi-file-earmark-text"></i>
            Détails du contenu
        </div>
        <div class="info-value mb-3">{{ $paiement->contenu->titre }}</div>
        <div class="row">
            <div class="col-md-6">
                <small class="text-muted">Type : {{ $paiement->contenu->typecontenu->nom }}</small>
            </div>
            <div class="col-md-6">
                <small class="text-muted">Langue : {{ $paiement->contenu->langue->nom }}</small>
            </div>
        </div>
    </div>

    <!-- Métadonnées techniques -->
    @if($paiement->metadata)
    <h5 class="fw-bold mb-4 mt-5" style="color: #1e1b4b; font-size: 1.3rem;">
        <i class="bi bi-code-slash"></i>
        Informations techniques
    </h5>
    
    <div class="metadata-container">
        <pre class="metadata-pre">{{ json_encode(json_decode($paiement->metadata), JSON_PRETTY_PRINT) }}</pre>
    </div>
    @endif
</div>

@endsection