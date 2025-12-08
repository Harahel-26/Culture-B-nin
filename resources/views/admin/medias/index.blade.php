@extends('admin.layouts')

@section('title', 'Gestion des Médias')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }
    .page-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .page-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .btn-add {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    .btn-add:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-2px);
        color: white;
    }
    .alert-success {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        border: 2px solid #10b981;
        color: #065f46;
        border-radius: 12px;
        padding: 16px;
        font-weight: 600;
        margin-bottom: 25px;
    }
    .table-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
    }
    .table-header {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.03), rgba(138, 43, 226, 0.03));
        padding: 20px 25px;
        border-bottom: 1px solid rgba(30, 27, 75, 0.1);
    }
    .table-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e1b4b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .table-title i {
        color: #8a2be2;
    }
    .table {
        margin: 0;
    }
    .table thead th {
        border: none;
        padding: 18px 20px;
        font-weight: 700;
        color: #1e1b4b;
        background: rgba(30, 27, 75, 0.03);
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }
    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(30, 27, 75, 0.05);
    }
    .table tbody tr:hover {
        background: rgba(138, 43, 226, 0.03);
    }
    .table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border: none;
    }
    .media-thumb {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .video-thumb {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .video-thumb:hover {
        transform: scale(1.05);
    }
    .audio-thumb {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .media-info h6 {
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: 5px;
    }
    .media-info small {
        color: #6b7280;
        font-size: 0.85rem;
    }
    .badge-type {
        background: rgba(30, 27, 75, 0.1);
        color: #1e1b4b;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-status {
        padding: 8px 14px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-pending {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
    }
    .status-validated {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }
    .status-rejected {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        font-size: 1rem;
        margin-right: 6px;
    }
    .btn-view {
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        color: white;
    }
    .btn-approve {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }
    .btn-reject {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }
    .btn-delete {
        background: linear-gradient(135deg, #6b7280, #9ca3af);
        color: white;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .pagination-container {
        background: rgba(30, 27, 75, 0.02);
        padding: 20px;
        border-top: 1px solid rgba(30, 27, 75, 0.05);
    }
</style>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-collection-play"></i>
        Médias
    </h1>
    
    <a href="{{ route('admin.medias.create') }}" class="btn-add">
        <i class="bi bi-plus-circle"></i>
        Ajouter un média
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
    <div class="table-header">
        <h3 class="table-title">
            <i class="bi bi-list-columns"></i>
            Liste des médias
        </h3>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Aperçu</th>
                    <th>Informations</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medias as $media)
                <tr>
                    <!-- Aperçu -->
                    <td>
                        @if($media->typeMedia->nom === 'image')
                            <img src="{{ asset('storage/'.$media->fichier) }}" 
                                 class="media-thumb"
                                 alt="{{ $media->titre }}">
                        @elseif($media->typeMedia->nom === 'video')
                            <div class="video-thumb" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#modalVideo{{ $media->id }}">
                                <i class="bi bi-play-circle" style="font-size: 2rem; color: white;"></i>
                            </div>
                        @else
                            <div class="audio-thumb">
                                <i class="bi bi-music-note-beamed" style="font-size: 2rem; color: white;"></i>
                            </div>
                        @endif
                    </td>

                    <!-- Informations -->
                    <td>
                        <div class="media-info">
                            <h6>{{ $media->titre ?? 'Sans titre' }}</h6>
                            <small>
                                <i class="bi bi-journal-text"></i>
                                {{ $media->contenu->titre ?? 'Non associé' }}
                            </small><br>
                            <small>
                                <i class="bi bi-person"></i>
                                {{ $media->uploader->name }}
                            </small>
                        </div>
                    </td>

                    <!-- Type -->
                    <td>
                        <span class="badge-type">
                            <i class="bi bi-{{ $media->typeMedia->nom === 'image' ? 'image' : ($media->typeMedia->nom === 'video' ? 'camera-video' : 'music-note-beamed') }}"></i>
                            {{ ucfirst($media->typeMedia->nom) }}
                        </span>
                    </td>

                    <!-- Statut -->
                    <td>
                        @if($media->status == 'pending')
                            <span class="badge-status status-pending">
                                <i class="bi bi-clock"></i>
                                En attente
                            </span>
                        @elseif($media->status == 'validated')
                            <span class="badge-status status-validated">
                                <i class="bi bi-check-circle"></i>
                                Validé
                            </span>
                        @else
                            <span class="badge-status status-rejected">
                                <i class="bi bi-x-circle"></i>
                                Rejeté
                            </span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="text-end">
                        <a href="{{ route('admin.medias.show', $media) }}"
                           class="btn-action btn-view"
                           title="Voir détails">
                            <i class="bi bi-eye"></i>
                        </a>
                        
                        @if($media->status !== 'validated')
                            <a href="{{ route('admin.medias.valider', $media) }}"
                               class="btn-action btn-approve"
                               title="Valider"
                               onclick="return confirm('Valider ce média ?')">
                                <i class="bi bi-check2-circle"></i>
                            </a>
                        @endif
                        
                        @if($media->status !== 'rejected')
                            <a href="{{ route('admin.medias.rejeter', $media) }}"
                               class="btn-action btn-reject"
                               title="Rejeter"
                               onclick="return confirm('Rejeter ce média ?')">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                        
                        <form action="{{ route('admin.medias.destroy', $media) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Supprimer définitivement ce média ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn-action btn-delete"
                                    title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal vidéo -->
                @if($media->typeMedia->nom === 'video')
                <div class="modal fade" id="modalVideo{{ $media->id }}" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-dark border-0">
                            <video controls autoplay style="width:100%; border-radius: 8px;">
                                <source src="{{ asset('storage/'.$media->fichier) }}">
                            </video>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    @if($medias->hasPages())
        <div class="pagination-container">
            {{ $medias->links() }}
        </div>
    @endif
</div>

@endsection