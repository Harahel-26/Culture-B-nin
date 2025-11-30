@extends('layout.app')

@section('title', 'Dashboard')

@section('page-title', 'Tableau de bord')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

<!-- Info Boxes -->
<div class="row">
    <!-- Total Contenus -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-primary shadow-sm">
                <i class="bi bi-file-earmark-text"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Contenus</span>
                <span class="info-box-number">
                    {{ \App\Models\Contenu::count() }}
                </span>
            </div>
        </div>
    </div>

    <!-- En attente de validation -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-warning shadow-sm">
                <i class="bi bi-clock-history"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">En attente</span>
                <span class="info-box-number">
                    {{ \App\Models\Contenu::where('status', 'pending')->count() }}
                </span>
            </div>
        </div>
    </div>

    <!-- Total Traductions -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-success shadow-sm">
                <i class="bi bi-translate"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Traductions</span>
                <span class="info-box-number">
                    {{ \App\Models\ContenuTraduction::count() }}
                </span>
            </div>
        </div>
    </div>

    <!-- Total Utilisateurs -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-info shadow-sm">
                <i class="bi bi-people"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Utilisateurs</span>
                <span class="info-box-number">
                    {{ \App\Models\User::count() }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Contenus récents -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contenus récents</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.contenus.index') }}" class="btn btn-sm btn-primary">
                        Voir tous
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Langue</th>
                                <th>Auteur</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Contenu::with(['langue', 'auteur'])->latest()->take(5)->get() as $contenu)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.contenus.show', $contenu) }}">
                                        {{ Str::limit($contenu->titre, 30) }}
                                    </a>
                                </td>
                                <td>{{ $contenu->langue->nom }}</td>
                                <td>{{ $contenu->auteur->name }}</td>
                                <td>
                                    @if($contenu->status === 'validated')
                                        <span class="badge text-bg-success">Validé</span>
                                    @elseif($contenu->status === 'pending')
                                        <span class="badge text-bg-warning">En attente</span>
                                    @else
                                        <span class="badge text-bg-danger">Rejeté</span>
                                    @endif
                                </td>
                                <td>{{ $contenu->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques par langue -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contenus par langue</h3>
            </div>
            <div class="card-body">
                <canvas id="langueChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique des contenus par langue
    const ctx = document.getElementById('langueChart');

    const langues = @json(\App\Models\Langue::withCount('contenus')->get());

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: langues.map(l => l.nom),
            datasets: [{
                data: langues.map(l => l.contenus_count),
                backgroundColor: [
                    '#0d6efd',
                    '#20c997',
                    '#ffc107',
                    '#d63384',
                    '#6f42c1'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endpush
