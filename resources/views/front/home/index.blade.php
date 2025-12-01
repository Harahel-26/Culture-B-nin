@extends('front.layouts.app')

@section('title', 'Culture du Bénin – Découvrez notre patrimoine')

@section('hero')
    <h1 class="fw-bold display-5 mb-3">Découvrez la richesse culturelle du Bénin</h1>
    <p class="lead">Langues, traditions, arts, rythmes, histoires & savoirs… Explorez un patrimoine vivant.</p>
@endsection

@section('content')

{{-- SECTION 1 : DIAPORAMA --}}
<div id="heroCarousel" class="carousel slide mb-5 shadow rounded" data-bs-ride="carousel">
    <div class="carousel-inner rounded">
        <div class="carousel-item active">
            <img src="{{ asset('images/slides/benin1.jpg') }}" class="d-block w-100" style="height:480px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-4">
                <h3><i class="bi bi-gem me-2"></i>Patrimoine Culturel</h3>
                <p>Un héritage vivant transmis de génération en génération.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/slides/benin2.jpg') }}" class="d-block w-100" style="height:480px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-4">
                <h3><i class="bi bi-brush me-2"></i>Art & Artisanat</h3>
                <p>Le savoir-faire béninois, reconnu mondialement.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/slides/benin3.jpg') }}" class="d-block w-100" style="height:480px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-4">
                <h3><i class="bi bi-translate me-2"></i>Langues & Traditions</h3>
                <p>Une diversité linguistique et culturelle exceptionnelle.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

{{-- SECTION 2 : À LA DÉCOUVERTE --}}
<div class="content-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-content">
                    <h2 class="section-title">À la découverte du Bénin</h2>
                    <p class="section-text">
                        Terre de traditions, d'histoire et de créativité,
                        le Bénin est l'un des berceaux de la culture africaine.
                        Explorez ses langues, ses récits, ses rythmes, ses arts, ses peuples et son génie créatif.
                    </p>
                    <a href="{{ route('front.contenus.index') }}" class="btn btn-search">
                        <i class="bi bi-compass me-2"></i>Explorer les contenus
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/culture-degrade.jpg') }}" alt="Culture béninoise" class="section-image">
            </div>
        </div>
    </div>
</div>

{{-- SECTION 3 : DERNIERS MÉDIAS VIDÉOS --}}
<div class="content-section alternate-bg">
    <div class="container">
        <h2 class="section-title"><i class="bi bi-camera-reel me-2"></i>Dernières Vidéos</h2>
        
        <div class="row g-4">
            @foreach($latestVideos ?? [] as $video)
                <div class="col-md-4">
                    <div class="card card-custom">
                        <video class="w-100" height="200" controls preload="metadata" style="border-radius: 0;">
                            <source src="{{ asset('storage/' . $video->fichier) }}" type="video/mp4">
                        </video>
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $video->titre }}</h5>
                            <p class="text-muted">{{ Str::limit($video->description, 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(empty($latestVideos) || count($latestVideos) == 0)
                <div class="col-12 text-center">
                    <p class="text-muted"><i class="bi bi-film me-2"></i>Aucune vidéo disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- SECTION 4 : GALERIE D'IMAGES --}}
<div class="content-section">
    <div class="container">
        <h2 class="section-title"><i class="bi bi-images me-2"></i>Galerie d'images</h2>
        
        <div class="row g-3">
            @foreach($gallery ?? [] as $img)
                <div class="col-6 col-md-3">
                    <div class="gallery-img">
                        <img src="{{ asset('storage/'.$img->fichier) }}" alt="{{ $img->titre ?? 'Image culturelle' }}">
                    </div>
                </div>
            @endforeach

            @if(empty($gallery) || count($gallery) == 0)
                <div class="col-12 text-center">
                    <p class="text-muted"><i class="bi bi-image me-2"></i>Aucune image disponible.</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- SECTION 5 : DERNIERS CONTENUS --}}
<div class="content-section alternate-bg">
    <div class="container">
        <h2 class="section-title"><i class="bi bi-journal-text me-2"></i>Derniers Contenus publiés</h2>
        
        <div class="row g-4">
            @foreach($latestContenus ?? [] as $c)
                <div class="col-md-4">
                    <div class="card card-custom">
                        <img src="{{ asset('images/default-content.jpg') }}" class="card-img-top" alt="{{ $c->titre }}">
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $c->titre }}</h5>
                            <p class="text-muted">{{ Str::limit($c->description, 120) }}</p>
                            <a href="{{ route('front.contenus.show', $c->slug) }}" class="btn btn-sm btn-search">
                                <i class="bi bi-book me-2"></i>Lire plus
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(empty($latestContenus) || count($latestContenus) == 0)
                <div class="col-12 text-center">
                    <p class="text-muted"><i class="bi bi-journal me-2"></i>Aucun contenu pour le moment.</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- SECTION 6 : AUDIOS --}}
<div class="content-section">
    <div class="container">
        <h2 class="section-title"><i class="bi bi-music-note-beamed me-2"></i>Audios & Rythmes</h2>
        
        <div class="row g-4">
            @foreach($latestAudios ?? [] as $audio)
                <div class="col-md-4">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h5 class="fw-bold"><i class="bi bi-mic me-2"></i>{{ $audio->titre }}</h5>
                            <audio controls class="w-100 mt-2">
                                <source src="{{ asset('storage/' . $audio->fichier) }}" type="audio/mpeg">
                            </audio>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(empty($latestAudios) || count($latestAudios) == 0)
                <div class="col-12 text-center">
                    <p class="text-muted"><i class="bi bi-volume-up me-2"></i>Aucun audio disponible.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Styles spécifiques pour cette page */
    .gallery-img {
        border-radius: 12px;
        overflow: hidden;
        height: 200px;
        transition: all 0.4s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .gallery-img:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .gallery-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-search {
        border-radius: 30px;
        background: linear-gradient(135deg, var(--accent-brown) 0%, var(--accent-dark) 100%);
        color: white;
        font-weight: 600;
        padding: 0.8rem 2rem;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-search:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(139, 115, 85, 0.4);
        color: white;
    }

    audio {
        border-radius: 25px;
        height: 40px;
    }
</style>
@endpush