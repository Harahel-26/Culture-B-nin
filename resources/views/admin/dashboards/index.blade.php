@extends('layouts')

@section('page-title', 'Tableau de bord')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

<div class="row">

    <!-- STATISTIQUES -->
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-bold">Contenus</h5>
                <p class="fs-3">{{ $stats['contenus_total'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-bold">En attente</h5>
                <p class="fs-3 text-warning">{{ $stats['contenus_attente'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-bold">Validés</h5>
                <p class="fs-3 text-success">{{ $stats['contenus_valides'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-bold">Utilisateurs</h5>
                <p class="fs-3">{{ $stats['users_total'] }}</p>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">

    <!-- GRAPHIQUE CONTENUS PAR MOIS -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Contenus publiés (12 derniers mois)</div>
            <div class="card-body">
                <canvas id="chartContenusMois"></canvas>
            </div>
        </div>
    </div>

    <!-- LANGUES LES PLUS UTILISÉES -->
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

    <!-- TYPES DE CONTENU LES PLUS CRÉÉS -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Types de contenu les plus créés</div>
            <div class="card-body">
                <canvas id="chartTypes"></canvas>
            </div>
        </div>
    </div>

    <!-- UTILISATEURS PAR ROLE -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Utilisateurs par rôle</div>
            <div class="card-body">
                <canvas id="chartRoles"></canvas>
            </div>
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
