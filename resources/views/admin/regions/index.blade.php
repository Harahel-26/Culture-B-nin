@extends('admin.layouts')

@section('title', 'Gestion des Régions')

@section('content')

<style>
    .premium-card {
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        padding: 20px;
        transition: .3s;
    }
    .premium-card:hover {
        box-shadow: 0 6px 22px rgba(0,0,0,0.15);
    }
    .region-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1e1b4b;
    }
    .badge-type {
        background: #1e1b4b;
        color: #fff;
        font-size: .75rem;
        padding: 6px 10px;
        border-radius: 6px;
    }
    .badge-langue {
        background: #d4a017;
        color: #fff;
        font-size: .75rem;
        padding: 6px 10px;
        border-radius: 6px;
    }
</style>

<div class="d-flex justify-content-between mb-3">
    <h3 class="fw-bold" style="color:#1e1b4b;">📍 Régions du Bénin</h3>

    <a href="{{ route('admin.regions.create') }}" class="btn btn-primary"
       style="background:#1e1b4b; border:none;">
        <i class="bi bi-plus-circle"></i> Nouvelle Région
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Langue principale</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($regions as $region)
                <tr class="premium-card">
                    <td>{{ $region->id }}</td>

                    <td>
                        <span class="region-title">{{ $region->nom }}</span>
                    </td>

                    <td>
                        <span class="badge-type">{{ $region->type ?? 'Non défini' }}</span>
                    </td>

                    <td>
                        @if($region->languePrincipale)
                            <span class="badge-langue">
                                {{ $region->languePrincipale->nom }}
                            </span>
                        @else
                            <span class="text-muted">Aucune</span>
                        @endif
                    </td>

                    <td>
                        @if($region->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.regions.show', $region) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.regions.edit', $region) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.regions.destroy', $region) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cette région ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <div class="card-footer">
        {{ $regions->links() }}
    </div>
</div>

@endsection
