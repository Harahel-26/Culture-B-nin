@extends('layouts')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Liste des régions</h3>
        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
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

                        <a href="{{ route('admin.regions.show', $region) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.regions.destroy', $region) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">
                                <i class="fas fa-trash"></i>
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
