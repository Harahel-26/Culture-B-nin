@extends('moderateur.layouts.app')

@section('title', 'Traductions en attente')

@section('content')

<h2 class="fw-bold mb-4">Traductions en attente</h2>

<table class="table shadow-sm">
    <thead>
        <tr>
            <th>Contenu</th>
            <th>Langue</th>
            <th>Traducteur</th>
            <th>Aperçu</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($trads as $t)
        <tr>
            <td>{{ $t->contenu->titre }}</td>
            <td>{{ $t->langue->nom }}</td>
            <td>{{ $t->traducteur->name }}</td>
            <td>{{ Str::limit($t->texte, 50) }}</td>

            <td class="d-flex gap-2">
                <form action="{{ route('moderateur.traductions.valider', $t) }}" method="POST">@csrf
                    <button class="btn btn-success btn-sm">✔</button>
                </form>

                <form action="{{ route('moderateur.traductions.rejeter', $t) }}" method="POST">@csrf
                    <button class="btn btn-danger btn-sm">✖</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $trads->links() }}

@endsection
