@extends('front.layouts.app')

@section('title', 'Acheter : ' . $contenu->titre)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-cart-check"></i> Acheter ce contenu
                    </h4>
                </div>

                <div class="card-body">
                    <!-- Résumé de l'achat -->
                    <div class="alert alert-info">
                        <h5><i class="bi bi-info-circle"></i> Résumé de votre achat</h5>
                        <p><strong>Contenu :</strong> {{ $contenu->titre }}</p>
                        <p><strong>Auteur :</strong> {{ $contenu->auteur->name }}</p>
                        <p><strong>Prix :</strong>
                            <span class="h4 text-success ms-2">
                                {{ number_format($contenu->prix, 0, ',', ' ') }} FCFA
                            </span>
                        </p>
                    </div>

                    <!-- Méthodes de paiement -->
                    <h5 class="mb-3">Choisissez votre méthode de paiement</h5>

                    <form action="{{ route('front.paiement.process', $contenu) }}" method="POST">
                        @csrf

                        <!-- Mobile Money -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="methode"
                                           value="mobile_money"
                                           id="mobile_money"
                                           checked>
                                    <label class="form-check-label w-100" for="mobile_money">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">
                                                    <i class="bi bi-phone"></i> Mobile Money
                                                </h6>
                                                <p class="mb-0 text-muted small">
                                                    MTN Mobile Money, Moov Money, etc.
                                                </p>
                                            </div>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1200px-Bitcoin.svg.png"
                                                 height="30" alt="Mobile Money">
                                        </div>
                                    </label>
                                </div>

                                <!-- Champs Mobile Money (masqués par défaut) -->
                                <div class="mt-3" id="mobile_money_fields">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Opérateur</label>
                                            <select name="operateur" class="form-select">
                                                <option value="mtn">MTN Mobile Money</option>
                                                <option value="moov">Moov Money</option>
                                                <option value="wave">Wave</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Numéro de téléphone</label>
                                            <input type="text"
                                                   name="telephone"
                                                   class="form-control"
                                                   placeholder="Ex: 97 00 00 00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte bancaire -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="methode"
                                           value="carte"
                                           id="carte">
                                    <label class="form-check-label w-100" for="carte">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">
                                                    <i class="bi bi-credit-card"></i> Carte bancaire
                                                </h6>
                                                <p class="mb-0 text-muted small">
                                                    Visa, MasterCard, etc.
                                                </p>
                                            </div>
                                            <div>
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg"
                                                     height="20" alt="Visa" class="me-2">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"
                                                     height="20" alt="MasterCard">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- PayPal -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="methode"
                                           value="paypal"
                                           id="paypal">
                                    <label class="form-check-label w-100" for="paypal">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">
                                                    <i class="bi bi-paypal"></i> PayPal
                                                </h6>
                                                <p class="mb-0 text-muted small">
                                                    Paiement sécurisé via PayPal
                                                </p>
                                            </div>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg"
                                                 height="30" alt="PayPal">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                               class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-lock"></i> Payer maintenant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Afficher/masquer les champs selon la méthode
    document.addEventListener('DOMContentLoaded', function() {
        const methods = document.querySelectorAll('input[name="methode"]');
        const mobileFields = document.getElementById('mobile_money_fields');

        function toggleFields() {
            const selectedMethod = document.querySelector('input[name="methode"]:checked').value;
            mobileFields.style.display = selectedMethod === 'mobile_money' ? 'block' : 'none';
        }

        methods.forEach(method => {
            method.addEventListener('change', toggleFields);
        });

        // Initial state
        toggleFields();
    });
</script>
@endpush
