@extends('admin.layouts.app')

@section('title', 'Médias en attente')

@section('content')

<h2 class="fw-bold mb-4">Médias en attente de validation</h2>

<table class="table table-striped shadow-sm">
    <thead>
        <tr>
            <th>Aperçu</th>
            <th>Titre</th>
            <th>Type</th>
            <th>Contenu</th>
            <th>Uploader</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($medias as $m)
        <tr>
            <td>
                @if(Str::contains($m->extension, ['jpg','jpeg','png','webp']))
                    <img src="{{ asset('storage/' . $m->fichier) }}" width="80">
                @else
                    <i class="bi bi-file-earmark"></i>
                @endif
            </td>

            <td>{{ $m->titre ?? '-' }}</td>
            <td>{{ $m->typeMedia->nom }}</td>
            <td>{{ $m->contenu->titre }}</td>
            <td>{{ $m->uploader->name }}</td>

            <td class="d-flex gap-2">
                <form action="{{ route('moderateur.medias.valider', $m) }}" method="POST">@csrf
                    <button class="btn btn-success btn-sm">✔</button>
                </form>

                <form action="{{ route('moderateur.medias.rejeter', $m) }}" method="POST">@csrf
                    <button class="btn btn-danger btn-sm">✖</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $medias->links() }}

@endsection
