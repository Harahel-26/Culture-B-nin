@extends('layout_projet')

@section('title', 'Paiements')

@section('content')

<style>
    .stat-card {
        background: #1e1b4b;
        color: #fff;
        border-radius: 12px;
        padding: 18px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .stat-card span {
        font-size: 1.7rem;
        font-weight: 700;
        color: #d4a017;
    }

    .badge-statut {
        padding: 6px 9px;
        border-radius: 6px;
        font-size: .8rem;
        font-weight: 600;
    }

    .paye { background:#28a745; color:#fff;}
    .en_attente { background:#ffc107; }
    .echec { background:#dc3545; color:#fff; }
    .annule { background:#6c757d; color:#fff; }

    .gateway-badge {
        background: #d4a017;
        padding: 5px 8px;
        border-radius: 6px;
        font-size: .75rem;
        color: #fff;
    }

</style>


<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-wallet2"></i> Paiements
</h3>

<!-- STATISTIQUES -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">Total<br><span>{{ $stats['total'] }}</span></div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">Payés<br><span>{{ $stats['paye'] }}</span></div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">En attente<br><span>{{ $stats['en_attente'] }}</span></div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">Échecs<br><span>{{ $stats['echec'] }}</span></div>
    </div>
</div>

<!-- FILTRES -->
<form method="GET" class="d-flex gap-2 mb-3">

    <select name="statut" class="form-select" style="max-width:180px;">
        <option value="">Tous statuts</option>
        <option value="paye" @selected(request('statut')=='paye')>Payé</option>
        <option value="en_attente" @selected(request('statut')=='en_attente')>En attente</option>
        <option value="echec" @selected(request('statut')=='echec')>Echec</option>
        <option value="annule" @selected(request('statut')=='annule')>Annulé</option>
    </select>

    <select name="gateway" class="form-select" style="max-width:180px;">
        <option value="">Toutes plateformes</option>
        <option value="fedapay" @selected(request('gateway')=='fedapay')>FedaPay</option>
        <option value="kkiapay" @selected(request('gateway')=='kkiapay')>Kkiapay</option>
    </select>

    <button class="btn btn-primary" style="background:#1e1b4b; border:none;">
        <i class="bi bi-funnel"></i> Filtrer
    </button>

</form>

<!-- TABLEAU -->
<div class="card shadow-sm">
    <div class="table-responsive">

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Référence</th>
                    <th>Utilisateur</th>
                    <th>Contenu</th>
                    <th>Montant</th>
                    <th>Gateway</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($paiements as $p)
                <tr>

                    <td>{{ $p->reference }}</td>

                    <td>
                        <strong>{{ $p->user->name }}</strong><br>
                        <small class="text-muted">{{ $p->user->email }}</small>
                    </td>

                    <td>
                        <strong>{{ $p->contenu->titre }}</strong>
                    </td>

                    <td>{{ number_format($p->montant, 2, ',', ' ') }} {{ $p->devise }}</td>

                    <td>
                        <span class="gateway-badge">
                            {{ strtoupper($p->gateway) }}
                        </span>
                    </td>

                    <td>
                        <span class="badge-statut {{ $p->statut }}">
                            {{ ucfirst(str_replace('_',' ', $p->statut)) }}
                        </span>
                    </td>

                    <td>{{ $p->created_at->format('d/m/Y') }}</td>

                    <td>
                        <a href="{{ route('admin.paiements.show', $p) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    <div class="card-footer">
        {{ $paiements->links() }}
    </div>
</div>

@endsection
