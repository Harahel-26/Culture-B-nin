@extends('admin.layouts.app')

@section('title', 'Commentaires en attente')

@section('content')

<h2 class="fw-bold mb-4">Commentaires en attente</h2>

<table class="table shadow-sm">
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Contenu</th>
            <th>Note</th>
            <th>Commentaire</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($commentaires as $c)
        <tr>
            <td>{{ $c->utilisateur->name }}</td>
            <td>{{ $c->contenu->titre }}</td>
            <td>{{ $c->note }}</td>
            <td>{{ \Illuminate\Support\Str::limit($c->commentaire, 50) }}</td>

            <td class="d-flex gap-2">
                <!-- Valider -->
                        @if($commentaire->statut !== 'validated')
                        <form action="{{ route('admin.commentaires.valider', $commentaire->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success">
                                <i class="bi bi-check2"></i>
                            </button>
                        </form>
                        @endif

                        <!-- Rejeter -->
                        @if($commentaire->statut !== 'rejected')
                        <form action="{{ route('admin.commentaires.rejeter', $commentaire->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-warning text-dark">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                        @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $commentaires->links() }}

@endsection
