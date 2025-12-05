@extends('admin.layouts')

@section('title', 'Gestion des contenus')

@section('content')

<style>
    .badge-premium {
        background: #d4a017;
        color: #fff;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: .75rem;
        font-weight: 600;
    }
    .badge-status {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: .8rem;
    }
    .draft { background: #6c757d; color: #fff; }
    .pending { background: #ffc107; }
    .validated { background: #28a745; color: #fff; }
    .rejected { background: #dc3545; color: #fff; }

    .cover-thumb {
        width: 70px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eee;
    }
</style>

<div class="d-flex justify-content-between mb-4">
    <h3 class="fw-bold" style="color:#1e1b4b;">
        <i class="bi bi-journal-text"></i> Contenus
    </h3>

    <a href="{{ route('admin.contenus.create') }}"
       class="btn btn-primary" style="background:#1e1b4b; border:none;">
        <i class="bi bi-plus-circle"></i> Nouveau contenu
    </a>
</div>

<div class="card shadow-sm">

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Couverture</th>
                    <th>Titre</th>
                    <th>Langue</th>
                    <th>Type</th>
                    <th>Premium</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @foreach($contenus as $c)
                <tr>

                    <td>
                        <img src="{{ $c->image_couverture ? asset('storage/'.$c->image_couverture) : asset('images/default-cover.jpg') }}"
                            class="cover-thumb">
                    </td>

                    <td>
                        <strong>{{ $c->titre }}</strong>
                    </td>

                    <td>{{ $c->langue->nom }}</td>

                    <td>{{ $c->typecontenu->nom }}</td>

                    <td>
                        @if($c->is_premium)
                            <span class="badge-premium">Premium</span>
                        @else
                            <span class="text-muted">Gratuit</span>
                        @endif
                    </td>

                    <td>
                        <span class="badge-status {{ $c->status }}">
                            {{ ucfirst($c->status) }}
                        </span>
                    </td>

                    <td>{{ $c->utilisateur->name }}</td>

                    <td class="text-end">

                        <a href="{{ route('admin.contenus.show', $c) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.contenus.edit', $c) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.contenus.destroy', $c) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce contenu ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $contenus->links() }}
    </div>

</div>

@endsection
