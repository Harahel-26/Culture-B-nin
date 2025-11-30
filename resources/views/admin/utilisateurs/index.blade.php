@extends('layouts')

@section('page-title', 'Utilisateurs')

@section('breadcrumb')
<li class="breadcrumb-item active">Utilisateurs</li>
@endsection

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Liste des utilisateurs</h4>

        <a href="{{ route('utilisateurs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Ajouter
        </a>
    </div>

    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom & Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Date d’inscription</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($utilisateurs as $u)
                <tr>
                    <td>{{ $u->id }}</td>

                    <td>
                        <strong>{{ $u->prenom }} {{ $u->nom }}</strong>
                    </td>

                    <td>{{ $u->email }}</td>

                    <td>
                        @if($u->roles->first())
                            <span class="badge bg-primary">
                                {{ ucfirst($u->roles->first()->name) }}
                            </span>
                        @else
                            <span class="badge bg-secondary">Aucun</span>
                        @endif
                    </td>

                    <td>
                        @if($u->is_active)
                            <span class="badge bg-success">Actif</span>
                        @else
                            <span class="badge bg-danger">Inactif</span>
                        @endif
                    </td>

                    <td>{{ $u->created_at->format('d/m/Y') }}</td>

                    <td class="text-end">

                        {{-- Show --}}
                        <a href="{{ route('utilisateurs.show', $u) }}"
                           class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('utilisateurs.edit', $u) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('utilisateurs.destroy', $u) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
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

        <!-- Pagination -->
        <div class="mt-3">
            {{ $utilisateurs->links() }}
        </div>

    </div>

</div>

@endsection
