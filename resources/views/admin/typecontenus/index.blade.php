@extends('admin.layouts')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Types de contenus</h3>

        <a href="{{ route('admin.typecontenus.create') }}" class="btn btn-primary" title="Ajouter">
            <i class="bi bi-plus-circle me-1"></i>
        </a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $t)
                <tr>
                    <td>{{ $t->nom }}</td>

                    <td class="text-end">

                        <a href="{{ route('admin.typecontenus.show', $t) }}" class="btn btn-sm btn-info" title="voir">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.typecontenus.edit', $t) }}" class="btn btn-sm btn-warning" title="modifier">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.typecontenus.destroy', $t) }}" method="POST" class="d-inline">
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

        {{ $types->links() }}
    </div>
</div>
@endsection
