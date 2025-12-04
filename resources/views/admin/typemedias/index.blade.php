@extends('admin.layouts')

@section('content')
<div class="card">

    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Types de médias</h3>

        <a href="{{ route('admin.typemedias.create') }}" class="btn btn-primary">
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
                @foreach($medias as $m)
                <tr>
                    <td>{{ $m->nom }}</td>

                    <td class="text-end">

                        <a href="{{ route('admin.typemedias.show', $m) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.typemedias.edit', $m) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.typemedias.destroy', $m) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">
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
