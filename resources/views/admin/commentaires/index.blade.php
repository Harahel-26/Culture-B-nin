@extends('layouts')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h3 class="card-title">Commentaires</h3>
    <form method="GET" class="d-flex">
        <select name="statut" class="form-control form-control-sm me-2">
            <option value="">Tous</option>
            <option value="pending" {{ request('statut')=='pending' ? 'selected':'' }}>En attente</option>
            <option value="validated" {{ request('statut')=='validated' ? 'selected':'' }}>Validés</option>
            <option value="rejected" {{ request('statut')=='rejected' ? 'selected':'' }}>Rejetés</option>
        </select>
        <button class="btn btn-sm btn-primary">Filtrer</button>
    </form>
  </div>

  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Contenu</th>
          <th>Auteur</th>
          <th>Note</th>
          <th>Commentaire</th>
          <th>Statut</th>
          <th>Date</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($commentaires as $c)
        <tr>
          <td>{{ $c->contenu->titre ?? '—' }}</td>
          <td>{{ $c->auteur->name ?? '—' }}</td>
          <td>{{ $c->note }}/5</td>
          <td>{{ \Illuminate\Support\Str::limit($c->commentaire, 80) }}</td>
          <td>
            @if($c->statut=='pending') <span class="badge bg-warning">En attente</span>
            @elseif($c->statut=='validated') <span class="badge bg-success">Validé</span>
            @else <span class="badge bg-danger">Rejeté</span> @endif
          </td>
          <td>{{ $c->created_at->format('d/m/Y') }}</td>
          <td class="text-end">
            <a href="{{ route('admin.commentaires.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
            @if($c->statut != 'validated')
            <form action="{{ route('admin.commentaires.valider', $c) }}" method="POST" class="d-inline">
              @csrf @method('PUT')
              <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
            </form>
            @endif
            @if($c->statut != 'rejected')
            <form action="{{ route('admin.commentaires.rejeter', $c) }}" method="POST" class="d-inline">
              @csrf @method('PUT')
              <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
            </form>
            @endif
            <form action="{{ route('admin.commentaires.destroy', $c) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $commentaires->links() }}
  </div>
</div>
@endsection
