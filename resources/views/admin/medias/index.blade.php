@extends('admin.layouts')

@section('title', 'Gestion des Médias')

@section('content')

<style>
    .media-card-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #eee;
    }

    .video-preview, .audio-preview {
        width: 120px;
        height: 80px;
        border-radius: 6px;
    }

    .status-badge {
        font-size: .8rem;
        padding: 6px 10px;
        border-radius: 6px;
    }

    .status-pending { background: #ffc107; color: #000; }
    .status-validated { background: #28a745; color: #fff; }
    .status-rejected { background: #dc3545; color: #fff; }

    .media-table-row:hover {
        background: rgba(0,0,0,0.03);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold" style="color:#1e1b4b;">
        <i class="bi bi-collection-play"></i> Médias
    </h3>

    <a href="{{ route('admin.medias.create') }}" class="btn btn-primary" style="background:#1e1b4b; border:none;">
        <i class="bi bi-plus-circle"></i> Ajouter un média
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Aperçu</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Auteur</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($medias as $media)
                <tr class="media-table-row">

                    <!-- Aperçu -->
                    <td>
                        @if($media->typeMedia->nom === 'image')
                            <img src="{{ asset('storage/'.$media->fichier) }}" class="media-card-img">

                        @elseif($media->typeMedia->nom === 'video')
                            <video class="video-preview" controls>
                                <source src="{{ asset('storage/'.$media->fichier) }}">
                            </video>

                        @elseif($media->typeMedia->nom === 'audio')
                            <audio controls class="audio-preview">
                                <source src="{{ asset('storage/'.$media->fichier) }}">
                            </audio>

                        @else
                            <i class="bi bi-file-earmark"></i>
                        @endif
                    </td>

                    <!-- Titre -->
                    <td>
                        <strong>{{ $media->titre ?? 'Sans titre' }}</strong><br>
                        <small class="text-muted">{{ $media->contenu->titre ?? 'Aucun contenu associé' }}</small>
                    </td>

                    <!-- Type -->
                    <td>
                        <span class="badge bg-primary">{{ $media->typeMedia->nom }}</span>
                    </td>

                    <!-- Uploader -->
                    <td>
                        <i class="bi bi-person"></i> {{ $media->uploader->name }}
                    </td>

                    <!-- Statut -->
                    <td>
                        @if($media->status == 'pending')
                            <span class="status-badge status-pending">En attente</span>
                        @elseif($media->status == 'validated')
                            <span class="status-badge status-validated">Validé</span>
                        @else
                            <span class="status-badge status-rejected">Rejeté</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td>

                        <a href="{{ route('admin.medias.show', $media) }}"
                            class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        @if($media->status !== 'validated')
                            <a href="{{ route('admin.medias.valider', $media) }}"
                                class="btn btn-sm btn-success">
                                <i class="bi bi-check2-circle"></i>
                            </a>
                        @endif

                        @if($media->status !== 'rejected')
                            <a href="{{ route('admin.medias.rejeter', $media) }}"
                                class="btn btn-sm btn-warning text-dark">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif

                        <form action="{{ route('admin.medias.destroy', $media) }}"
                              class="d-inline"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce média ?')">
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
        {{ $medias->links() }}
    </div>
</div>

@endsection
