@extends('admin.layouts')

@section('title', 'Gestion des commentaires')

@section('content')

<style>
    .stat-card {
        background: #1e1b4b;
        color: #fff;
        border-radius: 10px;
        padding: 18px;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stat-card span {
        font-size: 1.8rem;
        font-weight: 900;
        color: #d4a017;
    }

    .status-badge {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: .8rem;
        font-weight: 600;
    }
    .pending { background:#ffc107; }
    .validated { background:#28a745; color:#fff; }
    .rejected { background:#dc3545; color:#fff; }

    .comment-text {
        max-width: 350px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-chat-text"></i> Commentaires
</h3>

<!-- STATS -->
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="stat-card">Total <br> <span>{{ $stats['total'] }}</span></div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">En attente <br> <span>{{ $stats['pending'] }}</span></div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">Validés <br> <span>{{ $stats['validated'] }}</span></div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">Rejetés <br> <span>{{ $stats['rejected'] }}</span></div>
    </div>

</div>

<!-- FILTRES -->
<div class="mb-3">
    <form method="GET" class="d-flex gap-2">

        <select name="statut" class="form-select" style="max-width:200px;">
            <option value="">Tous</option>
            <option value="pending" @selected(request('statut')=='pending')>En attente</option>
            <option value="validated" @selected(request('statut')=='validated')>Validés</option>
            <option value="rejected" @selected(request('statut')=='rejected')>Rejetés</option>
        </select>

        <button class="btn btn-primary" style="background:#1e1b4b; border:none;">
            <i class="bi bi-filter"></i> Filtrer
        </button>

    </form>
</div>

<!-- TABLEAU -->
<div class="card shadow-sm">

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Auteur</th>
                    <th>Contenu</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($commentaires as $commentaire)
                <tr>

                    <td>
                        <strong>{{ $commentaire->utilisateur->name }}</strong><br>
                        <small class="text-muted">{{ $commentaire->utilisateur->email }}</small>
                    </td>

                    <td>
                        <strong>{{ $commentaire->contenu->titre }}</strong>
                    </td>

                    <td>
                        @for($i=1; $i<=5; $i++)
                            <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill text-warning' : '' }}"></i>
                        @endfor
                    </td>

                    <td class="comment-text">
                        {{ $commentaire->commentaire }}
                    </td>

                    <td>
                        <span class="status-badge {{ $commentaire->statut }}">
                            {{ ucfirst($commentaire->statut) }}
                        </span>
                    </td>

                    <td>
                        {{ $commentaire->created_at->format('d/m/Y') }}
                    </td>

                    <td>

                        <a href="{{ route('admin.commentaires.show', $commentaire->id) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        @if($commentaire->statut !== 'validated')
                            <a href="{{ route('admin.commentaires.valider', $commentaire->id) }}"
                               class="btn btn-sm btn-success">
                                <i class="bi bi-check2"></i>
                            </a>
                        @endif

                        @if($commentaire->statut !== 'rejected')
                            <a href="{{ route('admin.commentaires.rejeter', $commentaire->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif

                        <form action="{{ route('admin.commentaires.destroy', $commentaire->id) }}"
                              class="d-inline"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce commentaire ?')">
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
        {{ $commentaires->links() }}
    </div>

</div>

@endsection
