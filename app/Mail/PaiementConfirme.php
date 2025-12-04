<?php

namespace App\Mail;

use App\Models\Paiement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaiementConfirme extends Mailable
{
    use Queueable, SerializesModels;

    public $paiement;
    public $contenu;
    public $user;

    public function __construct(Paiement $paiement)
    {
        $this->paiement = $paiement;
        $this->contenu = $paiement->contenu;
        $this->user = $paiement->user;
    }

    public function build()
    {
        return $this->subject('Confirmation de paiement - Bénin Culture')
                    ->markdown('emails.paiement.confirme')
                    ->with([
                        'montant' => number_format($this->paiement->montant, 0, ',', ' ') . ' FCFA',
                        'reference' => $this->paiement->reference,
                        'contenuTitre' => $this->contenu->titre,
                        'contenuUrl' => route('front.contenus.show', $this->contenu->slug),
                        'factureUrl' => route('front.paiement.facture', $this->paiement->reference),
                        'date' => $this->paiement->paye_le->format('d/m/Y à H:i')
                    ]);
    }
}
