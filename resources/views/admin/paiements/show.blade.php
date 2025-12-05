@extends('layout_projet')

@section('title', 'Détail du paiement')

@section('content')

<style>
    .detail-card {
        background:#fff;
        padding:30px;
        border-radius:14px;
        box-shadow:0 4px 15px rgba(0,0,0,0.1);
    }

    .label-premium {
        font-weight:600;
        color:#1e1b4b;
    }

    .value {
        font-size:1.1rem;
        margin-bottom:14px;
    }

    .gateway {
        padding:6px 10px;
        background:#d4a017;
        color:#fff;
        border-radius:6px;
    }

    .badge-statut {
        padding:6px 10px;
        border-radius:6px;
        font-size:.9rem;
    }

    .paye { background:#28a745; color:#fff; }
    .en_attente { background:#ffc107; }
    .echec { background:#dc3545; color:#fff; }
    .annule { background:#6c757d; color:#fff; }
</style>


<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-receipt"></i> Détail du paiement
</h3>

<div class="detail-card">

    <h5 class="label-premium">Référence</h5>
    <p class="value">{{ $paiement->reference }}</p>

    <h5 class="label-premium">Utilisateur</h5>
    <p class="value">{{ $paiement->user->name }} ({{ $paiement->user->email }})</p>

    <h5 class="label-premium">Contenu acheté</h5>
    <p class="value">{{ $paiement->contenu->titre }}</p>

    <h5 class="label-premium">Montant</h5>
    <p class="value">{{ number_format($paiement->montant, 2, ',', ' ') }} {{ $paiement->devise }}</p>

    <h5 class="label-premium">Passerelle de paiement</h5>
    <p class="value">
        <span class="gateway">{{ strtoupper($paiement->gateway) }}</span>
    </p>

    <h5 class="label-premium">Statut</h5>
    <p class="value">
        <span class="badge-statut {{ $paiement->statut }}">
            {{ ucfirst(str_replace('_',' ', $paiement->statut)) }}
        </span>
    </p>

    <h5 class="label-premium">Date de paiement</h5>
    <p class="value">
        {{ $paiement->paye_le ? $paiement->paye_le->format('d/m/Y à H:i') : '—' }}
    </p>

    <hr>

    <a href="{{ route('admin.paiements.index') }}" class="btn btn-secondary">
        Retour
    </a>

</div>

@endsection
