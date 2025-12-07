@extends('admin.layouts')

@section('title', 'Demandes contributeurs')

@section('content')

<h2 class="fw-bold mb-4">Demandes pour devenir contributeur</h2>

<table class="table table-striped shadow-sm">
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Motivation</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($demandes as $d)
        <tr>
            <td>{{ $d->user->name }}</td>
            <td>{{ $d->motivation ?? '-' }}</td>
            <td>
                <span class="badge
                    @if($d->statut=='pending') bg-warning
                    @elseif($d->statut=='accepted') bg-success
                    @else bg-danger @endif">
                    {{ $d->statut }}
                </span>
            </td>

            <td class="d-flex gap-2">

                @if($d->statut=='pending')
                <form method="POST" action="{{ route('admin.demandes.accepter', $d) }}">
                    @csrf
                    <button class="btn btn-success btn-sm">
                        Accepter
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.demandes.rejeter', $d) }}">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        Rejeter
                    </button>
                </form>
                @else
                    <small class="text-muted">Traité</small>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $demandes->links() }}

@endsection
