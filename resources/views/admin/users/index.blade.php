@extends('admin.layouts')

@section('page-title', 'Utilisateurs')

@section('breadcrumb')
<li class="breadcrumb-item active">Utilisateurs</li>
@endsection

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Liste des utilisateurs</h4>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary" title="Ajouter">
            <i class="bi bi-plus-circle me-1"></i>
        </a>
    </div>

    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Nom  Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Date d’inscription</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>

                    <td>
                        <strong>{{ $u->name }} </strong>
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
                        <a href="{{ route('admin.users.show', $u) }}"
                           class="btn btn-sm btn-info" title="voir">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('admin.users.edit', $u) }}"
                           class="btn btn-sm btn-warning" title="modifier">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('admin.users.destroy', $u) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="supprimer">
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
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection
