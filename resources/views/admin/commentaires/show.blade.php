@extends('admin.layouts')

@section('title', 'Détail du commentaire')

@section('content')

<style>
    .comment-box {
        padding: 25px;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(0,0,0,0.07);
    }

    .label-premium {
        font-weight: 600;
        color: #1e1b4b;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: .9rem;
    }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-chat-quote"></i> Commentaire
</h3>

<div class="comment-box">

    <h5 class="label-premium">Auteur</h5>
    <p>{{ $commentaire->utilisateur->name }} ({{ $commentaire->utilisateur->email }})</p>

    <h5 class="label-premium mt-4">Contenu concerné</h5>
    <p>{{ $commentaire->contenu->titre }}</p>

    <h5 class="label-premium mt-4">Note</h5>
    <p>
        @for($i=1; $i<=5; $i++)
            <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill text-warning' : '' }}"></i>
        @endfor
    </p>

    <h5 class="label-premium mt-4">Commentaire</h5>
    <p>{{ $commentaire->commentaire }}</p>

    <h5 class="label-premium mt-4">Statut</h5>
    <p>
        <span class="status-badge {{ $commentaire->statut }}">
            {{ ucfirst($commentaire->statut) }}
        </span>
    </p>

    <h5 class="label-premium mt-4">Date</h5>
    <p>{{ $commentaire->created_at->format('d/m/Y à H:i') }}</p>

    <hr>

    <a href="{{ route('admin.commentaires.index') }}" class="btn btn-secondary">
        Retour
    </a>

</div>

@endsection
