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
                <form action="{{ route('moderateur.commentaires.valider', $c) }}" method="POST">@csrf
                    <button class="btn btn-success btn-sm">✔</button>
                </form>

                <form action="{{ route('moderateur.commentaires.rejeter', $c) }}" method="POST">@csrf
                    <button class="btn btn-danger btn-sm">✖</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $commentaires->links() }}

@endsection
