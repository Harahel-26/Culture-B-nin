@extends('front.layouts.app')

@section('title', 'Paiement réussi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-check-circle"></i> Paiement réussi !
                    </h3>
                </div>
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>

                    <h4 class="mb-3">Merci pour votre achat !</h4>

                    <div class="alert alert-success">
                        <p class="mb-2">
                            <strong>Référence :</strong> {{ $paiement->reference }}
                        </p>
                        <p class="mb-2">
                            <strong>Montant :</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
                        </p>
                        <p class="mb-0">
                            <strong>Date :</strong> {{ $paiement->created_at->format('d/m/Y à H:i') }}
                        </p>
                    </div>

                    <p class="mb-4">
                        Vous pouvez maintenant accéder au contenu que vous avez acheté.
                    </p>

                    <div class="d-grid gap-2 col-md-8 mx-auto">
                        <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                           class="btn btn-primary btn-lg">
                            <i class="bi bi-eye"></i> Voir le contenu
                        </a>
                        <a href="{{ route('front.accueil') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-house"></i> Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
