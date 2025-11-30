@extends('layouts')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Liste des langues</h3>
        <a href="{{ route('admin.langues.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle langue
        </a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($langues as $langue)
                <tr>
                    <td>{{ $langue->code }}</td>
                    <td>{{ $langue->nom }}</td>

                    <td class="text-end">

                        <a href="{{ route('admin.langues.show',$langue) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.langues.edit',$langue) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.langues.destroy',$langue) }}" method="POST" class="d-inline">
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

        {{ $langues->links() }}
    </div>
</div>
@endsection
