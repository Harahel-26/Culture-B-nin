{{-- filepath: resources/views/admin/dashboards/index.blade.php --}}
@extends('admin.layouts')

@section('page-title', 'Tableau de bord')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4">Dashboard Admin</h1>

    <!-- Statistiques principales -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Contenus</h5>
                    <h2>{{ $stats['contenus']['total'] ?? $stats['contenus_total'] }}</h2>
                    <p class="mb-0">
                        {{ $stats['contenus']['valides'] ?? $stats['contenus_valides'] }} validés |
                        {{ $stats['contenus']['en_attente'] ?? $stats['contenus_attente'] }} en attente
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Utilisateurs</h5>
                    <h2>{{ $stats['users']['total'] ?? $stats['users_total'] }}</h2>
                    <p class="mb-0">
                        {{ $stats['users']['contributeurs'] ?? $stats['users_contributeurs'] }} contributeurs |
                        {{ $stats['users']['admins'] ?? $stats['users_admins'] }} admins
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-dark shadow-sm">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Commentaires</h5>
                    <h2>{{ $stats['commentaires']['total'] ?? ($stats['commentaires_total'] ?? 0) }}</h2>
                    <p class="mb-0">
                        {{ $stats['commentaires']['en_attente'] ?? ($stats['commentaires_attente'] ?? 0) }} en attente
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Revenus</h5>
                    <h2>{{ number_format($paiements['montant_total'] ?? 0, 0, ',', ' ') }} FCFA</h2>
                    <p class="mb-0">{{ $paiements['total'] ?? 0 }} paiements</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques et stats secondaires -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Contenus publiés (12 derniers mois)</div>
                <div class="card-body">
                    <canvas id="chartContenusMois"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Langues les plus utilisées</div>
                <div class="card-body">
                    <canvas id="chartLangues"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Types de contenu les plus créés</div>
                <div class="card-body">
                    <canvas id="chartTypes"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Utilisateurs par rôle</div>
                <div class="card-body">
                    <canvas id="chartRoles"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques Premium, Commentaires en attente -->
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="fw-bold">Contenus premium</h6>
                    <p class="fs-4">{{ $stats['contenus_premium'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="fw-bold">Commentaires en attente</h6>
                    <p class="fs-4">{{ $stats['commentaires_attente'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Paiements récents -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Paiements récents</h5>
        </div>
        <div class="card-body">
            @if(isset($paiements['recent']) && count($paiements['recent']) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Montant</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements['recent'] as $p)
                        <tr>
                            <td>{{ $p->user->name ?? 'Utilisateur' }}</td>
                            <td>{{ number_format($p->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted">Aucun paiement récent</p>
            @endif
        </div>
    </div>

    <!-- Contenus récents -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Contenus récents</h5>
        </div>
        <div class="card-body">
            @if(isset($contenusRecents) && $contenusRecents->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Langue</th>
                            <th>Statut</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contenusRecents as $contenu)
                        <tr>
                            <td>{{ $contenu->titre }}</td>
                            <td>{{ $contenu->auteur->name ?? 'N/A' }}</td>
                            <td>{{ $contenu->langue->nom ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $contenu->status == 'validated' ? 'success' : 'warning' }}">
                                    {{ $contenu->status }}
                                </span>
                            </td>
                            <td>{{ $contenu->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted">Aucun contenu récent</p>
            @endif
        </div>
    </div>

    <!-- Commentaires récents -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Commentaires récents</h5>
        </div>
        <div class="card-body">
            @if(isset($commentairesRecents) && $commentairesRecents->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Contenu</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commentairesRecents as $com)
                        <tr>
                            <td>{{ $com->utilisateur->name ?? '' }}</td>
                            <td>{{ $com->contenu->titre ?? '' }}</td>
                            <td>{{ $com->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted">Aucun commentaire récent</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Contenus par mois
    new Chart(document.getElementById('chartContenusMois'), {
        type: 'line',
        data: {
            labels: [@for($i=1;$i<=12;$i++) "{{ $i }}", @endfor],
            datasets: [{
                label: 'Contenus',
                data: {!! json_encode(array_values($contenus_mois)) !!},
                borderColor: "#0055aa",
                fill: false,
                tension: 0.3
            }]
        }
    });

    // Langues
    new Chart(document.getElementById('chartLangues'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($langues_plus->pluck('langue.nom')->toArray()) !!},
            datasets: [{
                label: 'Contenus',
                data: {!! json_encode($langues_plus->pluck('total')->toArray()) !!},
                backgroundColor: "#10b981"
            }]
        }
    });

    // Types de contenu
    new Chart(document.getElementById('chartTypes'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($types_plus->pluck('typecontenu.nom')->toArray()) !!},
            datasets: [{
                data: {!! json_encode($types_plus->pluck('total')->toArray()) !!},
                backgroundColor: ['#0055aa', '#facc15', '#ef4444', '#10b981', '#6366f1']
            }]
        }
    });

    // Utilisateurs par rôle
    new Chart(document.getElementById('chartRoles'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($users_roles->pluck('role_name')->toArray()) !!},
            datasets: [{
                data: {!! json_encode($users_roles->pluck('total')->toArray()) !!},
                backgroundColor: ['#0055aa', '#10b981', '#facc15', '#ef4444', '#8b5cf6']
            }]
        }
    });
</script>
@endsection
