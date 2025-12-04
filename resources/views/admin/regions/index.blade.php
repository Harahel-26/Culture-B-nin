@extends('admin.layouts')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Liste des régions</h3>
        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary" title="Ajouter">
            <i class="bi bi-plus-circle ma-1"></i>
        </a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Langue principale</th>
                    <th>Active</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($regions as $region)
                <tr>
                    <td>{{ $region->nom }}</td>
                    <td>{{ $region->type }}</td>
                    <td>{{ $region->langue_principale }}</td>
                    <td>{{ $region->is_active ? 'Oui' : 'Non' }}</td>

                    <td class="text-end">

                        <a href="{{ route('admin.regions.show', $region) }}" class="btn btn-sm btn-info" title="voir">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-sm btn-warning" title="mofifier">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.regions.destroy', $region) }}" method="POST" class="d-inline">
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

        {{ $regions->links() }}
    </div>
</div>
@endsection
