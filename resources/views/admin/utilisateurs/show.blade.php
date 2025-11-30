@extends('layouts')

@section('page-title', 'Détails utilisateur')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('utilisateurs.index') }}">Utilisateurs</a></li>
<li class="breadcrumb-item active">{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</li>
@endsection

@section('content')

<div class="row">

    <!-- INFO USER -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">

                <img src="{{ URL::asset('adminlte/img/user2-160x160.jpg') }}"
                     class="rounded-circle mb-3" width="120">

                <h4>{{ $utilisateur->name }}</h4>

                <p class="text-muted">{{ $utilisateur->email }}</p>

                <span class="badge bg-primary">
                    {{ $utilisateur->roles->first()->name ?? 'Aucun rôle' }}
                </span>

                <hr>

                <p>
                    <strong>Inscrit le :</strong><br>
                    {{ $utilisateur->created_at->format('d/m/Y à H:i') }}
                </p>

                <p>
                    <strong>Dernière connexion :</strong><br>
                    {{ $utilisateur->updated_at->format('d/m/Y à H:i') }}
                </p>

            </div>
        </div>
    </div>

    <!-- ACTIONS -->
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-header fw-bold">
                Actions rapides
            </div>
            <div class="card-body">

                <a href="{{ route('utilisateurs.edit', $utilisateur) }}"
                   class="btn btn-warning">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>

                <form action="{{ route('utilisateurs.destroy', $utilisateur) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Supprimer cet utilisateur ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </button>
                </form>

            </div>
        </div>

        <div class="card shadow-sm mt-3">
            <div class="card-header fw-bold">Informations supplémentaires</div>
            <div class="card-body">

                <p><strong>ID :</strong> {{ $utilisateur->id }}</p>
                <p><strong>Email vérifié :</strong>
                    @if ($utilisateur->email_verified_at)
                        <span class="badge bg-success">Oui</span>
                    @else
                        <span class="badge bg-danger">Non</span>
                    @endif
                </p>

            </div>
        </div>

    </div>
</div>

@endsection
