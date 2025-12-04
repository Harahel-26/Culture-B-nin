@extends('admin.layouts')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Liste des traductions</h3>
    </div>

    <div class="card-body">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Contenu</th>
                    <th>Langue</th>
                    <th>Traducteur</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($traductions as $t)
                <tr>
                    <td>{{ $t->contenu->titre ?? '—' }}</td>
                    <td>{{ $t->langue->nom ?? '—' }}</td>
                    <td>{{ $t->traducteur->name ?? '—' }}</td>

                    <td>
                        @if($t->status == 'pending')
                            <span class="badge bg-warning">En attente</span>
                        @elseif($t->status == 'validated')
                            <span class="badge bg-success">Validée</span>
                        @else
                            <span class="badge bg-danger">Rejetée</span>
                        @endif
                    </td>

                    <td>{{ $t->created_at->format('d/m/Y') }}</td>

                    <td class="text-end">

                        {{-- Show --}}
                        <a href="{{ route('traductions.show', $t) }}"
                           class="btn btn-sm btn-info">
                           <i class="bi bi-eye"></i>
                        </a>

                        {{-- Edit → seulement pour le traducteur --}}
                        @if($t->traduit_par == auth()->id())
                            <a href="{{ route('traductions.edit', $t) }}"
                               class="btn btn-sm btn-warning">
                               <i class="bi bi-pencil-square"></i>
                            </a>
                        @endif

                        {{-- Validation admin --}}
                        @if(auth()->user()->hasRole(['admin','moderateur']) && $t->status != 'validated')
                            <form action="{{ route('traductions.valider', $t) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <button class="btn btn-sm btn-success">
                                    <i class="bi bi-check"></i>
                                </button>
                            </form>
                        @endif

                        {{-- Rejet admin --}}
                        @if(auth()->user()->hasRole(['admin','moderateur']) && $t->status != 'rejected')
                            <form action="{{ route('traductions.rejeter', $t) }}"
                                  method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @endif

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $traductions->links() }}

    </div>

</div>

@endsection
