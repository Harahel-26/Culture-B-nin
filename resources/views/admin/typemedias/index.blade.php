@extends('admin.layouts')

@section('title', 'Types de Médias')

@section('content')

<style>
    .media-card {
        border-radius: 14px;
        background: #ffffff;
        transition: .3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }
    .media-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }
    .media-title {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.05rem;
    }
</style>

<div class="d-flex justify-content-between mb-3">
    <h3 class="fw-bold" style="color:#1e1b4b;">
        <i class="bi bi-collection-play"></i> Types de Médias
    </h3>

    <a href="{{ route('admin.typemedias.create') }}" class="btn btn-primary"
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
                <th>#</th>
                <th>Nom</th>
                <th>Médias associés</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($typemedias as $type)
                <tr class="media-card">
                    <td>{{ $type->id }}</td>

                    <td class="media-title">
                        <i class="bi bi-tag"></i> {{ $type->nom }}
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            {{ $type->medias->count() }} médias
                        </span>
                    </td>

                    <td>

                        <a href="{{ route('admin.typemedias.show', $type) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.typemedias.edit', $type) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.typemedias.destroy', $type) }}"
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
        {{ $typemedias->links() }}
    </div>

</div>

@endsection
