<?php

namespace App\Http\Middleware;

use Closure;

class CheckContenuPremium
{
    public function handle($request, Closure $next)
    {
        $contenu = $request->route('contenu');

        if ($contenu->est_accessible) {
            return $next($request);
        }

        return redirect()->route('front.paiement.init', $contenu->id)
            ->with('warning', 'Ce contenu est premium.');
    }
}
