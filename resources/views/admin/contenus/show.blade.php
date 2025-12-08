@extends('admin.layouts')

@section('title', 'Détail du contenu')

@section('content')

<style>
    /* Styles généraux */
    .detail-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 12px 40px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        position: relative;
        overflow: hidden;
    }

    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #8a2be2, #1e1b4b, #d4a017);
    }

    /* Header */
    .page-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }

    .page-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2.2rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.4rem;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-top: 10px;
        padding-left: 45px;
    }

    /* Image de couverture */
    .cover-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        position: relative;
        border: 3px solid white;
    }

    .cover-large {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .cover-container:hover .cover-large {
        transform: scale(1.02);
    }

    .cover-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(30, 27, 75, 0.8), transparent);
        padding: 25px;
        color: white;
    }

    /* Titre principal */
    .content-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2.8rem;
        line-height: 1.2;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* Badges */
    .badge-container {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .badge-status {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .draft {
        background: linear-gradient(135deg, #6b7280, #9ca3af);
        color: white;
    }

    .pending {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
    }

    .validated {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }

    .rejected {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }

    .badge-premium {
        background: linear-gradient(135deg, #d4a017, #f59e0b);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(212, 160, 23, 0.2);
    }

    .badge-free {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    /* Cartes d'information */
    .info-section {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.03), rgba(138, 43, 226, 0.03));
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(30, 27, 75, 0.1);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .info-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #8a2be2;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .info-label {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 0.95rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-label i {
        color: #8a2be2;
    }

    .info-value {
        font-size: 1.1rem;
        color: #4b5563;
        font-weight: 600;
    }

    .info-value.highlight {
        color: #1e1b4b;
        font-size: 1.3rem;
    }

    /* Auteur */
    .author-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(14, 165, 233, 0.05));
        padding: 20px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid rgba(59, 130, 246, 0.1);
    }

    .author-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.5rem;
        box-shadow: 0 4px 15px rgba(138, 43, 226, 0.2);
    }

    .author-details {
        flex: 1;
    }

    .author-name {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .author-email {
        color: #6b7280;
        font-size: 0.95rem;
    }

    /* Contenu texte */
    .content-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }

    .section-title i {
        color: #8a2be2;
    }

    .content-body {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        line-height: 1.8;
        font-size: 1.1rem;
        color: #4b5563;
        border: 1px solid rgba(30, 27, 75, 0.05);
    }

    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 20px 0;
    }

    .content-body h2, .content-body h3 {
        color: #1e1b4b;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    /* Extrait premium */
    .preview-section {
        background: linear-gradient(135deg, rgba(212, 160, 23, 0.05), rgba(245, 158, 11, 0.05));
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(212, 160, 23, 0.2);
        position: relative;
        overflow: hidden;
    }

    .preview-section::before {
        content: 'PREVIEW';
        position: absolute;
        top: 10px;
        right: -30px;
        background: linear-gradient(135deg, #d4a017, #f59e0b);
        color: white;
        padding: 5px 40px;
        transform: rotate(45deg);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .preview-content {
        background: white;
        padding: 25px;
        border-radius: 12px;
        font-style: italic;
        color: #6b7280;
        border: 1px solid rgba(212, 160, 23, 0.1);
        position: relative;
    }

    .preview-content::before {
        content: '"';
        position: absolute;
        top: -15px;
        left: 20px;
        font-size: 4rem;
        color: rgba(212, 160, 23, 0.2);
        font-family: serif;
    }

    /* Médias */
    .media-section {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        border: 1px solid rgba(30, 27, 75, 0.05);
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .media-item {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        background: white;
    }

    .media-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .media-thumb {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .media-info {
        padding: 15px;
        border-top: 1px solid rgba(30, 27, 75, 0.05);
    }

    .media-type {
        font-size: 0.85rem;
        font-weight: 600;
        color: #8a2be2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .media-name {
        font-weight: 600;
        color: #1e1b4b;
        margin-top: 5px;
        font-size: 0.95rem;
    }

    .media-empty {
        text-align: center;
        padding: 40px 20px;
        color: #9ca3af;
    }

    .media-empty i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #e0e0e0;
    }

    /* Boutons d'action */
    .action-section {
        background: rgba(30, 27, 75, 0.02);
        padding: 25px;
        border-radius: 16px;
        margin-top: 40px;
        border: 1px solid rgba(30, 27, 75, 0.05);
    }

    .btn-action {
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: none;
    }

    .btn-primary-action {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        box-shadow: 0 6px 20px rgba(138, 43, 226, 0.2);
    }

    .btn-primary-action:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(138, 43, 226, 0.3);
        color: white;
    }

    .btn-success-action {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.2);
    }

    .btn-success-action:hover {
        background: linear-gradient(135deg, #34d399, #10b981);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .btn-warning-action {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.2);
    }

    .btn-warning-action:hover {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
        color: #1e1b4b;
    }

    .btn-secondary-action {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .btn-secondary-action:hover {
        background: #f8f9fa;
        border-color: #9ca3af;
        color: #374151;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    /* Statistiques */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .stat-item {
        background: white;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid rgba(30, 27, 75, 0.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1e1b4b;
        line-height: 1;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 600;
    }
</style>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-journal-text-fill"></i>
        Aperçu du Contenu
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-eye"></i>
        Visualisation détaillée du contenu
    </p>
</div>

<div class="detail-card">
    <!-- Image de couverture -->
    <div class="cover-container">
        @if($contenu->image_couverture)
            <img src="{{ asset('storage/'.$contenu->image_couverture) }}" 
                 class="cover-large"
                 alt="Couverture de {{ $contenu->titre }}">
        @else
            <img src="{{ asset('images/default-cover.jpg') }}" 
                 class="cover-large"
                 alt="Couverture par défaut">
        @endif
        <div class="cover-overlay">
            <div class="badge-container">
                <span class="badge-status {{ $contenu->status }}">
                    @if($contenu->status == 'draft')
                        <i class="bi bi-file-earmark"></i>
                    @elseif($contenu->status == 'pending')
                        <i class="bi bi-clock"></i>
                    @elseif($contenu->status == 'validated')
                        <i class="bi bi-check-circle"></i>
                    @elseif($contenu->status == 'rejected')
                        <i class="bi bi-x-circle"></i>
                    @endif
                    {{ ucfirst($contenu->status) }}
                </span>
                
                @if($contenu->is_premium)
                    <span class="badge-premium">
                        <i class="bi bi-gem"></i>
                        Premium — {{ $contenu->prix_formatte }}
                    </span>
                @else
                    <span class="badge-free">
                        <i class="bi bi-unlock"></i>
                        Gratuit
                    </span>
                @endif
            </div>
            <h2 class="content-title">{{ $contenu->titre }}</h2>
        </div>
    </div>

    <!-- Informations principales -->
    <div class="info-section">
        <h3 class="section-title">
            <i class="bi bi-info-circle"></i>
            Informations générales
        </h3>
        
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">
                    <i class="bi bi-translate"></i>
                    Langue
                </div>
                <div class="info-value highlight">{{ $contenu->langue->nom }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="bi bi-tags"></i>
                    Type de contenu
                </div>
                <div class="info-value highlight">{{ $contenu->typecontenu->nom }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="bi bi-geo-alt"></i>
                    Région
                </div>
                <div class="info-value">{{ $contenu->region->nom ?? 'Aucune région spécifique' }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="bi bi-calendar"></i>
                    Date de publication
                </div>
                <div class="info-value">
                    {{ $contenu->published_at ? $contenu->published_at->format('d/m/Y à H:i') : 'Non publié' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="info-section">
        <h3 class="section-title">
            <i class="bi bi-graph-up"></i>
            Statistiques
        </h3>
        
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value">{{ $contenu->vues_total }}</div>
                <div class="stat-label">Vues totales</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-value">{{ $contenu->likes_count ?? 0 }}</div>
                <div class="stat-label">J'aime</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-value">{{ $contenu->commentaires->count() }}</div>
                <div class="stat-label">Commentaires</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-value">{{ $contenu->favoris_count ?? 0 }}</div>
                <div class="stat-label">Favoris</div>
            </div>
        </div>
    </div>

    <!-- Auteur -->
    <div class="author-card">
        <div class="author-avatar">
            {{ substr($contenu->utilisateur->name, 0, 1) }}
        </div>
        <div class="author-details">
            <div class="author-name">{{ $contenu->utilisateur->name }}</div>
            <div class="author-email">{{ $contenu->utilisateur->email }}</div>
        </div>
    </div>

    <!-- Description -->
    @if($contenu->description)
    <div class="content-section">
        <h3 class="section-title">
            <i class="bi bi-text-paragraph"></i>
            Description
        </h3>
        <div class="content-body">
            {{ $contenu->description }}
        </div>
    </div>
    @endif

    <!-- Contenu principal -->
    <div class="content-section">
        <h3 class="section-title">
            <i class="bi bi-file-text"></i>
            Contenu détaillé
        </h3>
        <div class="content-body">
            {!! $contenu->contenu_texte !!}
        </div>
    </div>

    <!-- Extrait premium -->
    @if($contenu->is_premium && $contenu->extrait)
    <div class="preview-section">
        <h3 class="section-title">
            <i class="bi bi-eye"></i>
            Extrait gratuit (Aperçu)
        </h3>
        <div class="preview-content">
            {{ $contenu->extrait }}
        </div>
    </div>
    @endif

    <!-- Médias associés -->
    <div class="media-section">
        <h3 class="section-title">
            <i class="bi bi-collection"></i>
            Médias associés
        </h3>
        
        @if($contenu->medias->count() > 0)
            <div class="media-grid">
                @foreach($contenu->medias as $m)
                <div class="media-item">
                    @if($m->typeMedia->nom === 'image')
                        <img src="{{ asset('storage/'.$m->fichier) }}" 
                             class="media-thumb"
                             alt="{{ $m->titre ?? 'Image' }}">
                    @elseif($m->typeMedia->nom === 'video')
                        <video class="media-thumb" muted>
                            <source src="{{ asset('storage/'.$m->fichier) }}">
                        </video>
                    @elseif($m->typeMedia->nom === 'audio')
                        <div style="height: 150px; background: linear-gradient(135deg, #8a2be2, #1e1b4b); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-music-note-beamed" style="font-size: 3rem; color: white;"></i>
                        </div>
                    @endif
                    
                    <div class="media-info">
                        <div class="media-type">
                            <i class="bi bi-{{ $m->typeMedia->nom === 'image' ? 'image' : ($m->typeMedia->nom === 'video' ? 'camera-video' : 'music-note-beamed') }}"></i>
                            {{ ucfirst($m->typeMedia->nom) }}
                        </div>
                        <div class="media-name">
                            {{ $m->titre ?? 'Fichier sans titre' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="media-empty">
                <i class="bi bi-folder-x"></i>
                <h4>Aucun média associé</h4>
                <p>Ce contenu ne possède pas encore de fichiers multimédias.</p>
            </div>
        @endif
    </div>

    <!-- Actions -->
    <div class="action-section">
        <h3 class="section-title">
            <i class="bi bi-gear"></i>
            Actions
        </h3>
        
        <div class="d-flex flex-wrap gap-3">
            <!-- Actions administrateur/modérateur -->
            @hasrole('admin|moderateur')
                @if($contenu->status !== 'validated')
                    <a href="{{ route('admin.contenus.valider', $contenu) }}"
                       class="btn btn-action btn-success-action">
                        <i class="bi bi-check2-circle"></i>
                        Valider ce contenu
                    </a>
                @endif

                @if($contenu->status !== 'rejected')
                    <a href="{{ route('admin.contenus.rejeter', $contenu) }}"
                       class="btn btn-action btn-warning-action"
                       onclick="return confirm('Êtes-vous sûr de vouloir rejeter ce contenu ?')">
                        <i class="bi bi-x-circle"></i>
                        Rejeter
                    </a>
                @endif
            @endhasrole

            <!-- Actions générales -->
            <a href="{{ route('admin.contenus.edit', $contenu) }}" 
               class="btn btn-action btn-primary-action">
                <i class="bi bi-pencil-square"></i>
                Modifier
            </a>

            <a href="{{ route('admin.contenus.index') }}" 
               class="btn btn-action btn-secondary-action">
                <i class="bi bi-arrow-left"></i>
                Retour à la liste
            </a>

            <!-- Prévisualisation publique -->
            <a href="{{ route('admin.contenus.show', $contenu) }}" 
               target="_blank"
               class="btn btn-outline-primary"
               style="padding: 14px 24px; border-radius: 12px; font-weight: 600;">
                <i class="bi bi-eye"></i>
                Voir en public
            </a>
        </div>
    </div>
</div>

<!-- Script pour les vidéos -->
<script>
// Activer le son au clic sur les vidéos
document.querySelectorAll('video').forEach(video => {
    video.addEventListener('click', function() {
        if (this.muted) {
            this.muted = false;
        }
    });
    
    video.addEventListener('mouseenter', function() {
        this.play();
    });
    
    video.addEventListener('mouseleave', function() {
        this.pause();
        this.currentTime = 0;
    });
});

// Zoom sur l'image de couverture
document.querySelector('.cover-large').addEventListener('click', function() {
    const overlay = document.createElement('div');
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        cursor: zoom-out;
    `;
    
    const img = document.createElement('img');
    img.src = this.src;
    img.style.cssText = `
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    `;
    
    overlay.appendChild(img);
    document.body.appendChild(overlay);
    
    overlay.addEventListener('click', function() {
        document.body.removeChild(this);
    });
});
</script>

@endsection