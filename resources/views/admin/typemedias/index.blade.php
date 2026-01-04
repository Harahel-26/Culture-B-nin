@extends('admin.layouts')

@section('title', 'Types de Médias')

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
    .btn-add {
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
    .btn-add:hover {
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
        transform: translateX(4px);
    }
    .table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border: none;
    }
    .media-name {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .media-count {
        background: rgba(30, 27, 75, 0.1);
        color: #1e1b4b;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
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
        <i class="bi bi-collection-play"></i>
        Types de Médias
    </h1>

    <a href="{{ route('admin.typemedias.create') }}" class="btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter un type
    </a>
</div>


<div class="table-card">
    <div class="table-header">
        <h3 class="table-title">
            <i class="bi bi-list-columns"></i>
            Liste des types de médias
        </h3>
    </div>

    @if($typemedias->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Médias associés</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($typemedias as $type)
                    <tr>
                        <td>
                            <div class="media-name">
                                <i class="bi bi-{{ $type->nom === 'image' ? 'image' : ($type->nom === 'video' ? 'camera-video' : 'music-note-beamed') }}"></i>
                                {{ ucfirst($type->nom) }}
                            </div>
                        </td>

                        <td>
                            <span class="media-count">
                                {{ $type->medias->count() }} média(s)
                            </span>
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.typemedias.show', $type) }}"
                               class="btn-action btn-view"
                               title="Voir détails">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.typemedias.edit', $type) }}"
                               class="btn-action btn-edit"
                               title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.typemedias.destroy', $type) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Supprimer ce type de média ?')">
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

        @if($typemedias->hasPages())
            <div class="pagination-container">
                {{ $typemedias->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-collection" style="font-size: 3rem; color: #e0e0e0;"></i>
            </div>
            <h4 style="color: #6b7280;">Aucun type de média</h4>
            <p class="text-muted mb-4">Commencez par créer votre premier type de média</p>
            <a href="{{ route('admin.typemedias.create') }}" class="btn-add">
                <i class="bi bi-plus-circle"></i>
                Créer un type
            </a>
        </div>
    @endif
</div>

@endsection
