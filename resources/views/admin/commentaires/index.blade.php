@extends('admin.layouts')

@section('title', 'Gestion des commentaires')

@section('content')
<div class="container-fluid">
    <!-- En-tête avec statistiques -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-chat-text me-2"></i>Gestion des commentaires
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Boutons de filtres -->
                    <div class="btn-group mb-4" role="group">
                        <a href="{{ route('admin.commentaires.index') }}"
                           class="btn btn-outline-primary @if(!request()->has('statut')) active @endif">
                            Tous ({{ $stats['total'] }})
                        </a>
                        <a href="{{ route('admin.commentaires.index', ['statut' => 'pending']) }}"
                           class="btn btn-outline-warning @if(request('statut') == 'pending') active @endif">
                            <i class="bi bi-clock"></i> En attente ({{ $stats['pending'] }})
                        </a>
                        <a href="{{ route('admin.commentaires.index', ['statut' => 'validated']) }}"
                           class="btn btn-outline-success @if(request('statut') == 'validated') active @endif">
                            <i class="bi bi-check-circle"></i> Validés ({{ $stats['validated'] }})
                        </a>
                        <a href="{{ route('admin.commentaires.index', ['statut' => 'rejected']) }}"
                           class="btn btn-outline-danger @if(request('statut') == 'rejected') active @endif">
                            <i class="bi bi-x-circle"></i> Rejetés ({{ $stats['rejected'] }})
                        </a>
                    </div>

                    <!-- Cartes de statistiques -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-primary">Total</h5>
                                    <h2 class="display-6">{{ $stats['total'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-warning">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-warning">En attente</h5>
                                    <h2 class="display-6">{{ $stats['pending'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-success">Validés</h5>
                                    <h2 class="display-6">{{ $stats['validated'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-danger">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-danger">Rejetés</h5>
                                    <h2 class="display-6">{{ $stats['rejected'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des commentaires -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Contenu</th>
                                    <th>Utilisateur</th>
                                    <th>Commentaire</th>
                                    <th>Note</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($commentaires as $commentaire)
                                <tr>
                                    <td><strong>{{ $commentaire->id }}</strong></td>
                                    <td>
                                        <a href="{{ route('front.contenus.show', $commentaire->contenu->slug) }}"
                                           target="_blank"
                                           class="text-decoration-none"
                                           title="Voir le contenu">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>
                                            {{ Str::limit($commentaire->contenu->titre, 25) }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}"
                                                 alt="User"
                                                 class="rounded-circle me-2"
                                                 width="25"
                                                 height="25">
                                            {{ $commentaire->utilisateur->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span data-bs-toggle="tooltip"
                                              title="{{ $commentaire->commentaire }}">
                                            {{ Str::limit($commentaire->commentaire, 40) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-warning" title="{{ $commentaire->note }}/5">
                                            {{ str_repeat('★', $commentaire->note) }}{{ str_repeat('☆', 5 - $commentaire->note) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($commentaire->statut == 'pending')
                                            <span class="badge bg-warning">
                                                <i class="bi bi-clock"></i> En attente
                                            </span>
                                        @elseif($commentaire->statut == 'validated')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Validé
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle"></i> Rejeté
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>
                                            {{ $commentaire->created_at->format('d/m/Y') }}<br>
                                            <span class="text-muted">{{ $commentaire->created_at->format('H:i') }}</span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.commentaires.show', $commentaire->id) }}"
                                               class="btn btn-info"
                                               title="Voir détails">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            @if($commentaire->statut == 'pending')
                                            <form action="{{ route('admin.commentaires.valider', $commentaire->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-success"
                                                        title="Valider">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.commentaires.rejeter', $commentaire->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-danger"
                                                        title="Rejeter">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </form>
                                            @endif

                                            <form action="{{ route('admin.commentaires.destroy', $commentaire->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-outline-danger"
                                                        title="Supprimer"
                                                        onclick="return confirm('Supprimer définitivement ce commentaire ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-chat-dots display-6"></i>
                                            <p class="mt-2">Aucun commentaire à afficher</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($commentaires->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{ $commentaires->links() }}
                            </ul>
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialiser les tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
