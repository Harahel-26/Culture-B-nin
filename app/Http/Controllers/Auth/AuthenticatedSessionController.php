<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirection intelligente selon le rôle de l'utilisateur
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            // Admin va vers le dashboard admin
            return redirect()->route('admin.dashboards.index');
        } elseif ($user->hasRole(['contributeur', 'moderateur'])) {
            // Contributeurs et modérateurs vont vers leur profil
            return redirect()->route('front.profil.index');
        } else {
            // Simple utilisateur va vers l'accueil
            return redirect()->route('front.accueil');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('front.accueil');
    }
}