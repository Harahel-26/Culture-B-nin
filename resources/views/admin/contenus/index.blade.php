@extends('layouts')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Liste des contenus</h3>

        <a href="{{ route('admin.contenus.create') }}" class="btn btn-primary" title="Ajouter">
            <i class="bi bi-plus-circle me-1"></i>
        </a>
    </div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Langue</th>
                    <th>Région</th>
                    <th>Type</th>
                    <th>Auteur</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($contenus as $contenu)
                <tr>

                    <td>
                        @if($contenu->image_couverture)
                            <img src="{{ asset('storage/'.$contenu->image_couverture) }}"
                                 width="50" height="50" class="rounded">
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>

                    <td>{{ $contenu->titre }}</td>
                    <td>{{ $contenu->langue->nom }}</td>
                    <td>{{ $contenu->region->nom ?? '—' }}</td>
                    <td>{{ $contenu->typecontenu->nom }}</td>
                    <td>{{ $contenu->auteur->name }}</td>

                    <td>
                        @if($contenu->status == 'pending')
                            <span class="badge bg-warning">En attente</span>
                        @elseif($contenu->status == 'validated')
                            <span class="badge bg-success">Validé</span>
                        @elseif($contenu->status == 'rejected')
                            <span class="badge bg-danger">Rejeté</span>
                        @else
                            <span class="badge bg-secondary">Brouillon</span>
                        @endif
                    </td>

                    <td class="text-end">

                        {{-- Show --}}
                        <a href="{{ route('admin.contenus.show', $contenu) }}" class="btn btn-sm btn-info" title="voir">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('admin.contenus.edit', $contenu) }}" class="btn btn-sm btn-warning" title="modifier">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        {{-- Valider (si pas encore validé) --}}
                        @if($contenu->status != 'validated')
                        <form action="{{ route('admin.contenus.valider', $contenu) }}"
                              method="POST" class="d-inline">
                            @csrf @method('PUT')
                            <button class="btn btn-sm btn-success">
                                <i class="bi bi-check"></i>
                            </button>
                        </form>
                        @endif

                        {{-- Delete --}}
                        <form action="{{ route('admin.contenus.destroy', $contenu) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="supprimer" onclick="return confirm('Supprimer ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

        {{ $contenus->links() }}

    </div>

</div>

@endsection
