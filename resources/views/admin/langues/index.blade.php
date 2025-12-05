@extends('admin.layouts')

@section('title', 'Gestion des Langues')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Langues</h3>

    <a href="{{ route('admin.langues.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouvelle Langue
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Icône</th>
                <th>Nom</th>
                <th>Code</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($langues as $langue)
                <tr>
                    <td>{{ $langue->id }}</td>

                    <td>
                        <img src="{{ $langue->icone_url }}"
                             width="35" height="35"
                             class="rounded-circle border">
                    </td>

                    <td class="fw-bold">{{ $langue->nom }}</td>

                    <td><span class="badge bg-secondary">{{ $langue->code }}</span></td>

                    <td>
                        @if($langue->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('admin.langues.show', $langue) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.langues.edit', $langue) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.langues.destroy', $langue) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')

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
        {{ $langues->links() }}
    </div>
</div>

@endsection
