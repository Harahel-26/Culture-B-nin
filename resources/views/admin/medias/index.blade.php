@extends('admin.layouts')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des médias</h3>
    </div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Aperçu</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Type</th>
                    <th>Uploadé par</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($medias as $m)
                <tr>
                    <td>
                        @if(in_array($m->extension, ['jpg','jpeg','png']))
                            <img src="{{ asset('storage/'.$m->fichier) }}"
                                 width="60" class="rounded">
                        @else
                            <i class="fas fa-file"></i>
                        @endif
                    </td>

                    <td>{{ $m->titre ?? '—' }}</td>
                    <td>{{ $m->contenu->titre }}</td>
                    <td>{{ $m->typeMedia->nom }}</td>
                    <td>{{ $m->uploader->name }}</td>

                    <td>
                        @if($m->status == 'pending')
                            <span class="badge bg-warning">En attente</span>
                        @elseif($m->status == 'validated')
                            <span class="badge bg-success">Validé</span>
                        @else
                            <span class="badge bg-danger">Rejeté</span>
                        @endif
                    </td>

                    <td class="text-end">

                        {{-- Valider --}}
                        @if($m->status != 'validated')
                        <form method="POST" action="{{ route('medias.valider', $m) }}" class="d-inline">
                            @csrf @method('PUT')
                            <button class="btn btn-sm btn-success">
                                <i class="bi bi-check"></i>
                            </button>
                        </form>
                        @endif

                        {{-- Rejeter --}}
                        @if($m->status != 'rejected')
                        <form method="POST" action="{{ route('medias.rejeter', $m) }}" class="d-inline">
                            @csrf @method('PUT')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endif

                        {{-- Supprimer --}}
                        <form method="POST" action="{{ route('medias.destroy', $m) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-dark">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $medias->links() }}

    </div>
</div>

@endsection
