@extends('admin.layouts')

@section('title', 'Gestion des utilisateurs')

@section('content')

<style>
    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #eee;
    }

    .badge-role {
        background: #d4a017;
        color: #fff;
        font-size: .75rem;
        padding: 6px 10px;
        border-radius: 6px;
    }

    .badge-active {
        background: #28a745;
        padding: 5px 10px;
        border-radius: 6px;
        color: #fff;
        font-size: .75rem;
    }

    .badge-inactive {
        background: #dc3545;
        padding: 5px 10px;
        border-radius: 6px;
        color: #fff;
        font-size: .75rem;
    }

    .table-row-hover:hover {
        background: rgba(0,0,0,0.03);
    }
</style>

<div class="d-flex justify-content-between mb-3">
    <h3 class="fw-bold" style="color:#1e1b4b;">
        <i class="bi bi-people"></i> Utilisateurs
    </h3>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="background:#1e1b4b; border:none;">
        <i class="bi bi-plus-circle"></i> Nouvel utilisateur
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
                    <th>Avatar</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="table-row-hover">

                    <td>
                        <img src="{{ $user->avatar_url }}" class="user-avatar">
                    </td>

                    <td>
                        <strong>{{ $user->name }}</strong><br>
                        <small class="text-muted">{{ $user->username }}</small>
                    </td>

                    <td>{{ $user->email }}</td>

                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge-role">{{ $role->name }}</span>
                        @endforeach
                    </td>

                    <td>
                        @if($user->is_active)
                            <span class="badge-active">Actif</span>
                        @else
                            <span class="badge-inactive">Inactif</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
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
        {{ $users->links() }}
    </div>

</div>

@endsection
