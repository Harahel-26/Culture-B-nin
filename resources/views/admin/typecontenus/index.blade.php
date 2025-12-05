@extends('admin.layouts')

@section('title', 'Types de Contenu')

@section('content')

<style>
    .type-card {
        border-radius: 14px;
        background: #ffffff;
        transition: .3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }
    .type-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .type-title {
        font-weight: 700;
        font-size: 1.05rem;
        color: #1e1b4b;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold" style="color:#1e1b4b;">
        <i class="bi bi-folder2"></i> Types de Contenus
    </h3>

    <a href="{{ route('admin.typecontenus.create') }}" class="btn btn-primary"
       style="background:#1e1b4b; border:none;">
        <i class="bi bi-plus-circle"></i> Ajouter
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
                <th>N</th>
                <th>Nom</th>
                <th>Contenus associés</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($types as $type)
                <tr class="type-card">
                    <td>{{ $type->id }}</td>

                    <td class="type-title">
                        <i class="bi bi-tag"></i> {{ $type->nom }}
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            {{ $type->contenus->count() }} contenus
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('admin.typecontenus.show', $type) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.typecontenus.edit', $type) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.typecontenus.destroy', $type) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce type ?')">
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
        {{ $types->links() }}
    </div>
</div>

@endsection
