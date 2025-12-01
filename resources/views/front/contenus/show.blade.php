@extends('front.layouts.app')

@section('title', $contenu->titre . ' - Culture Bénin')

@section('content')

<div class="container py-4">

    {{-- Fil d'Ariane --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('front.accueil') }}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('front.contenus.index') }}">Contenus</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($contenu->titre, 50) }}</li>
        </ol>
    </nav>

    {{-- En-tête --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="fw-bold text-primary">{{ $contenu->titre }}</h1>

            {{-- Métadonnées --}}
            <div class="d-flex flex-wrap gap-3 mb-3">
                <span class="badge bg-success">{{ $contenu->typecontenu->nom }}</span>
                <span class="badge bg-info text-dark">
                    <i class="bi bi-translate"></i> {{ $contenu->langue->nom }}
                </span>
                <span class="badge bg-warning text-dark">
                    <i class="bi bi-geo-alt"></i> {{ $contenu->region->nom }}
                </span>

                {{-- Notes --}}
                @if($totalNotes > 0)
                <span class="badge bg-light text-dark">
                    <i class="bi bi-star-fill text-warning"></i>
                    {{ number_format($moyenneNotes, 1) }} ({{ $totalNotes }} avis)
                </span>
                @endif
            </div>

            {{-- Auteur et date --}}
            <div class="text-muted small">
                <i class="bi bi-person"></i> Par {{ $contenu->auteur->name }}
                • <i class="bi bi-calendar"></i> {{ $contenu->created_at->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    <div class="row">

        {{-- Contenu principal --}}
        <div class="col-lg-8">

            {{-- Image principale --}}
            @if($contenu->image_couverture)
            <div class="mb-4">
                <img src="{{ asset('storage/'.$contenu->image_couverture) }}"
                     alt="{{ $contenu->titre }}"
                     class="img-fluid rounded shadow-sm w-100"
                     style="max-height: 400px; object-fit: cover;">
            </div>
            @endif

            {{-- Description --}}
            @if($contenu->description)
            <div class="mb-4">
                <h5 class="fw-bold">Description</h5>
                <p class="lead">{{ $contenu->description }}</p>
            </div>
            @endif

            {{-- Contenu texte --}}
            @if($contenu->contenu_texte)
            <div class="mb-4">
                <div class="content-text">
                    {!! nl2br(e($contenu->contenu_texte)) !!}
                </div>
            </div>
            @endif

            {{-- Médias associés --}}
            @if($contenu->medias->count() > 0)
            <div class="mb-5">
                <h5 class="fw-bold mb-3">📁 Médias associés</h5>

                {{-- Images --}}
                @php $images = $contenu->medias->where('type_media_id', 1); @endphp
                @if($images->count() > 0)
                <div class="mb-4">
                    <h6 class="fw-semibold">Images ({{ $images->count() }})</h6>
                    <div class="row g-2">
                        @foreach($images as $media)
                        <div class="col-6 col-md-3">
                            <img src="{{ asset('storage/'.$media->fichier) }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="height: 120px; width: 100%; object-fit: cover;"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imageModal"
                                 data-src="{{ asset('storage/'.$media->fichier) }}"
                                 data-title="{{ $media->titre ?? $contenu->titre }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Vidéos --}}
                @php $videos = $contenu->medias->where('type_media_id', 2); @endphp
                @if($videos->count() > 0)
                <div class="mb-4">
                    <h6 class="fw-semibold">Vidéos ({{ $videos->count() }})</h6>
                    <div class="row g-3">
                        @foreach($videos as $media)
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <video controls class="w-100 rounded-top" style="height: 200px;">
                                    <source src="{{ asset('storage/'.$media->fichier) }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la lecture vidéo.
                                </video>
                                @if($media->titre)
                                <div class="card-body">
                                    <p class="card-text small">{{ $media->titre }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Audios --}}
                @php $audios = $contenu->medias->where('type_media_id', 3); @endphp
                @if($audios->count() > 0)
                <div class="mb-4">
                    <h6 class="fw-semibold">Audios ({{ $audios->count() }})</h6>
                    @foreach($audios as $media)
                    <div class="card shadow-sm mb-2">
                        <div class="card-body">
                            <h6 class="card-title">{{ $media->titre ?? 'Audio' }}</h6>
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/'.$media->fichier) }}" type="audio/mpeg">
                                Votre navigateur ne supporte pas la lecture audio.
                            </audio>
                            @if($media->description)
                            <p class="card-text text-muted small mt-2">{{ $media->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            {{-- Section Commentaires --}}
            <div class="mb-5">
                <h5 class="fw-bold mb-3">💬 Commentaires ({{ $contenu->commentaires->count() }})</h5>

                {{-- Formulaire commentaire --}}
                @auth
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form action="{{ route('commentaires.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Votre note</label>
                                <div class="rating-stars">
                                    @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="note" value="{{ $i }}" required>
                                    <label for="star{{ $i }}" class="star-label">
                                        <i class="bi bi-star"></i>
                                    </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Votre commentaire</label>
                                <textarea name="commentaire" class="form-control" rows="4"
                                          placeholder="Partagez votre avis..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-send"></i> Publier le commentaire
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="alert alert-info">
                    <a href="{{ route('login') }}" class="fw-bold">Connectez-vous</a> pour laisser un commentaire.
                </div>
                @endauth

                {{-- Liste des commentaires --}}
                <div class="comments-list">
                    @forelse($contenu->commentaires as $commentaire)
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong>{{ $commentaire->auteur->name }}</strong>
                                    <span class="text-warning ms-2">
                                        @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill' : '' }}"></i>
                                        @endfor
                                    </span>
                                </div>
                                <small class="text-muted">
                                    {{ $commentaire->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <p class="mb-0">{{ $commentaire->commentaire }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-chat-dots display-4"></i>
                        <p class="mt-2">Aucun commentaire pour le moment.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">

            {{-- Suggestions --}}
            @if($suggestions->count() > 0)
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white">
                    <h6 class="fw-bold mb-0">📚 Vous aimerez aussi</h6>
                </div>
                <div class="card-body">
                    @foreach($suggestions as $suggestion)
                    <a href="{{ route('front.contenus.show', $suggestion->slug) }}"
                       class="text-decoration-none text-dark">
                        <div class="d-flex mb-3 pb-3 border-bottom">
                            <img src="{{ $suggestion->image_couverture ? asset('storage/'.$suggestion->image_couverture) : asset('images/default-content.jpg') }}"
                                 class="rounded me-3"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="fw-semibold mb-1">{{ Str::limit($suggestion->titre, 50) }}</h6>
                                <small class="text-muted">
                                    {{ $suggestion->typecontenu->nom }} •
                                    {{ $suggestion->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

</div>

{{-- Modal pour images --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="imageModalSrc" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.rating-stars {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
}
.rating-stars input {
    display: none;
}
.rating-stars .star-label {
    cursor: pointer;
    font-size: 1.5rem;
    color: #ddd;
    transition: color 0.2s;
}
.rating-stars input:checked ~ .star-label,
.rating-stars .star-label:hover,
.rating-stars .star-label:hover ~ .star-label {
    color: #ffc107;
}
.content-text {
    line-height: 1.8;
    font-size: 1.1rem;
}
</style>
@endpush

@push('scripts')
<script>
// Modal image
document.addEventListener('DOMContentLoaded', function() {
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));

    document.querySelectorAll('img[data-bs-toggle="modal"]').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('imageModalSrc').src = this.dataset.src;
            document.getElementById('imageModalTitle').textContent = this.dataset.title;
            imageModal.show();
        });
    });
});
</script>
@endpush
