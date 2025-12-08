@extends('admin.layouts')

@section('title', 'Gestion des utilisateurs')

@section('content')

<style>
    .user-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(30, 27, 75, 0.15);
        transition: all 0.3s ease;
    }
    .user-avatar:hover {
        transform: scale(1.1);
        border-color: #8a2be2;
    }

    .badge-role {
        background: linear-gradient(135deg, #8a2be2 0%, #6d28d9 100%);
        color: white;
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        letter-spacing: 0.3px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        display: inline-block;
        margin: 2px;
    }

    .badge-active {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        padding: 6px 14px;
        border-radius: 20px;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .badge-inactive {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        padding: 6px 14px;
        border-radius: 20px;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .header-container {
        background: linear-gradient(135deg, #1e1b4b 0%, #3730a3 100%);
        border-radius: 16px;
        padding: 25px 30px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 8px 25px rgba(30, 27, 75, 0.2);
    }

    .header-title {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .btn-primary-enhanced {
        background: linear-gradient(135deg, #d4a017 0%, #f59e0b 100%);
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        color: #1e1b4b;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(212, 160, 23, 0.3);
    }
    .btn-primary-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 160, 23, 0.4);
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: #1e1b4b;
    }

    .table-enhanced {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: none;
    }

    .table-enhanced thead th {
        background: linear-gradient(135deg, #1e1b4b 0%, #2a2470 100%);
        color: white;
        border: none;
        padding: 18px 24px;
        font-weight: 700;
        font-size: 1rem;
    }

    .table-enhanced tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(30, 27, 75, 0.05);
    }
    .table-enhanced tbody tr:hover {
        background: rgba(138, 43, 226, 0.03);
        transform: translateX(4px);
    }

    .table-enhanced tbody td {
        padding: 18px 24px;
        vertical-align: middle;
        color: #374151;
        font-weight: 500;
    }

    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        margin: 0 3px;
        text-decoration: none;
    }
    .btn-view { background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); color: white; }
    .btn-edit { background: linear-gradient(135deg, #d4a017 0%, #f59e0b 100%); color: white; }
    .btn-delete { background: linear-gradient(135deg, #ef4444 0%, #f87171 100%); color: white; }
    .btn-action:hover {
        transform: translateY(-2px) scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .alert-success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        font-weight: 500;
        margin-bottom: 25px;
    }

    .pagination-container {
        background: white;
        border-radius: 16px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
</style>

<div class="header-container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="header-title">
            <i class="bi bi-people-fill"></i>
            Gestion des Utilisateurs
        </h1>
        <a href="{{ route('admin.users.create') }}" class="btn-primary-enhanced">
            <i class="bi bi-plus-circle-fill"></i>
            Nouvel utilisateur
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
    </div>
@endif

<div class="table-enhanced">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
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
                <tr>
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
                        <a href="{{ route('admin.users.show', $user) }}" class="btn-action btn-view">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            @csrf @method('DELETE')
                            <button class="btn-action btn-delete" type="submit">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-container">
    {{ $users->links() }}
</div>

@endsection
