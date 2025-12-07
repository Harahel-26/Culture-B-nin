@extends('admin.layouts.app')

@section('title', 'Contenus en attente')

@section('content')

<h2 class="fw-bold mb-4">Contenus en attente de validation</h2>

<table class="table table-striped table-hover shadow-sm">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Langue</th>
            <th>Type</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($contenus as $c)
        <tr>
            <td>{{ $c->titre }}</td>
            <td>{{ $c->utilisateur->name }}</td>
            <td>{{ $c->langue->nom }}</td>
            <td>{{ $c->typecontenu->nom }}</td>
            <td>{{ $c->created_at->format('d/m/Y') }}</td>

            <td class="d-flex gap-2">
                <form action="{{ route('moderateur.contenus.valider', $c) }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm">
                        <i class="bi bi-check"></i> Valider
                    </button>
                </form>

                <form action="{{ route('moderateur.contenus.rejeter', $c) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        <i class="bi bi-x"></i> Rejeter
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $contenus->links() }}

@endsection
