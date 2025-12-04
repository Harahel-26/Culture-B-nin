@extends('front.layouts.app')

@section('title', 'Médias - Culture Bénin')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">
        <i class="bi bi-collection-play"></i> Galerie multimédia
    </h1>
    
    <div class="row">
        <!-- Images -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-images"></i> Images
                    </h5>
                </div>
                <div class="card-body">
                    @if($images->count() > 0)
                    <div class="row">
                        @foreach($images->take(4) as $image)
                        <div class="col-6 mb-3">
                            <div class="bg-light rounded p-2 text-center" style="height: 100px;">
                                <i class="bi bi-image display-4 text-muted"></i>
                            </div>
                            <small class="d-block text-center mt-1">
                                {{ Str::limit($image->titre, 20) }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('front.medias.images') }}" class="btn btn-outline-info w-100">
                        Voir toutes les images ({{ $images->total() }})
                    </a>
                    @else
                    <p class="text-muted text-center py-3">Aucune image disponible</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Vidéos -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-camera-reels"></i> Vidéos
                    </h5>
                </div>
                <div class="card-body">
                    @if($videos->count() > 0)
                    <div class="row">
                        @foreach($videos->take(4) as $video)
                        <div class="col-6 mb-3">
                            <div class="bg-light rounded p-2 text-center" style="height: 100px;">
                                <i class="bi bi-play-circle display-4 text-muted"></i>
                            </div>
                            <small class="d-block text-center mt-1">
                                {{ Str::limit($video->titre, 20) }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('front.medias.videos') }}" class="btn btn-outline-danger w-100">
                        Voir toutes les vidéos ({{ $videos->total() }})
                    </a>
                    @else
                    <p class="text-muted text-center py-3">Aucune vidéo disponible</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Audios -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-mic"></i> Audios
                    </h5>
                </div>
                <div class="card-body">
                    @if($audios->count() > 0)
                    <div class="row">
                        @foreach($audios->take(4) as $audio)
                        <div class="col-6 mb-3">
                            <div class="bg-light rounded p-2 text-center" style="height: 100px;">
                                <i class="bi bi-music-note-beamed display-4 text-muted"></i>
                            </div>
                            <small class="d-block text-center mt-1">
                                {{ Str::limit($audio->titre, 20) }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('front.medias.audios') }}" class="btn btn-outline-warning w-100">
                        Voir tous les audios ({{ $audios->total() }})
                    </a>
                    @else
                    <p class="text-muted text-center py-3">Aucun audio disponible</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection