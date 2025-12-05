@extends('admin.layouts')

@section('title', 'Détail du contenu')

@section('content')

<style>
    .cover-large {
        width: 100%;
        max-height: 320px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.15);
    }

    .label-premium {
        font-weight: 600;
        color: #1e1b4b;
        font-size: 1.1rem;
    }

    .badge-status {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: .85rem;
    }

    .draft { background:#6c757d; color:#fff; }
    .pending { background:#ffc107; }
    .validated { background:#28a745; color:#fff; }
    .rejected { background:#dc3545; color:#fff; }

    .badge-premium {
        background: #d4a017;
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: .8rem;
        font-weight: 600;
    }

    .media-thumb {
        width: 120px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        border:1px solid #ccc;
        margin-right: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-journal-text"></i> Aperçu du contenu
</h3>

<div class="card shadow-sm p-4">

    {{-- IMAGE DE COUVERTURE --}}
    @if($contenu->image_couverture)
        <img src="{{ asset('storage/'.$contenu->image_couverture) }}" class="cover-large">
    @else
        <img src="{{ asset('images/default-cover.jpg') }}" class="cover-large">
    @endif

    {{-- TITRE --}}
    <h2 class="fw-bold mb-2" style="color:#1e1b4b;">{{ $contenu->titre }}</h2>

    {{-- STATUT --}}
    <span class="badge-status {{ $contenu->status }}">
        {{ ucfirst($contenu->status) }}
    </span>

    {{-- PREMIUM OU GRATUIT --}}
    @if($contenu->is_premium)
        <span class="badge-premium ms-2">
            Premium — {{ $contenu->prix_formatte }}
        </span>
    @else
        <span class="text-muted ms-2">Gratuit</span>
    @endif

    <hr class="my-4">

    {{-- INFORMATIONS --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <p class="label-premium">Langue :</p>
            <p>{{ $contenu->langue->nom }}</p>
        </div>

        <div class="col-md-4">
            <p class="label-premium">Région :</p>
            <p>{{ $contenu->region->nom ?? 'Aucune' }}</p>
        </div>

        <div class="col-md-4">
            <p class="label-premium">Type :</p>
            <p>{{ $contenu->typecontenu->nom }}</p>
        </div>

        <div class="col-md-4">
            <p class="label-premium">Auteur :</p>
            <p>{{ $contenu->utilisateur->name }}</p>
        </div>

        <div class="col-md-4">
            <p class="label-premium">Publié le :</p>
            <p>{{ $contenu->published_at ? $contenu->published_at->format('d/m/Y') : 'Non publié' }}</p>
        </div>

        <div class="col-md-4">
            <p class="label-premium">Vues :</p>
            <p>{{ $contenu->vues_total }}</p>
        </div>
    </div>

    <hr class="my-4">

    {{-- DESCRIPTION --}}
    @if($contenu->description)
        <h4 class="label-premium">Description</h4>
        <p>{{ $contenu->description }}</p>
        <hr class="my-4">
    @endif

    {{-- CONTENU TEXTE --}}
    <h4 class="label-premium">Contenu</h4>
    <div class="border rounded p-3 mb-4">
        {!! $contenu->contenu_texte !!}
    </div>

    {{-- EXTRAIT GRAPHIQUE --}}
    @if($contenu->is_premium)
        <h4 class="label-premium">Extrait gratuit (aperçu)</h4>
        <div class="border rounded p-3 bg-light">
            {{ $contenu->extrait }}
        </div>
        <hr class="my-4">
    @endif

    {{-- MÉDIAS ASSOCIÉS --}}
    <h4 class="label-premium">Médias associés</h4>

    @if($contenu->medias->count() > 0)
        <div class="d-flex flex-wrap">
            @foreach($contenu->medias as $m)

                @if($m->typeMedia->nom === 'image')
                    <img src="{{ asset('storage/'.$m->fichier) }}" class="media-thumb">

                @elseif($m->typeMedia->nom === 'video')
                    <video src="{{ asset('storage/'.$m->fichier) }}" class="media-thumb" muted></video>

                @elseif($m->typeMedia->nom === 'audio')
                    <audio controls class="me-3" style="height:40px;">
                        <source src="{{ asset('storage/'.$m->fichier) }}">
                    </audio>
                @endif

            @endforeach
        </div>
    @else
        <p class="text-muted">Aucun média associé.</p>
    @endif

    <hr class="my-4">

    {{-- ACTIONS ADMIN --}}
    <div class="d-flex gap-2">

        @hasrole('admin|moderateur')

            @if($contenu->status !== 'validated')
                <a href="{{ route('admin.contenus.valider', $contenu) }}"
                   class="btn btn-success">
                    <i class="bi bi-check2"></i> Valider
                </a>
            @endif

            @if($contenu->status !== 'rejected')
                <a href="{{ route('admin.contenus.rejeter', $contenu) }}"
                   class="btn btn-warning">
                    <i class="bi bi-x-circle"></i> Rejeter
                </a>
            @endif

        @endhasrole

        <a href="{{ route('admin.contenus.edit', $contenu) }}" class="btn btn-primary" style="background:#1e1b4b;">
            <i class="bi bi-pencil"></i> Modifier
        </a>

        <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>

    </div>

</div>

@endsection
