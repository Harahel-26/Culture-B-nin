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

        $user = Auth::user();

        // METTRE À JOUR LA DERNIÈRE CONNEXION
        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
            'last_login_user_agent' => $request->header('User-Agent'),
        ]);

        // Redirections selon le rôle
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboards.index');
        }

        if ($user->hasRole('moderateur')) {
            return redirect()->route('moderateur.dashboard');
        }

        if ($user->hasRole('contributeur')) {
            return redirect()->route('contributeur.dashboard');
        }

        // LECTEUR
        return redirect()->route('front.home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.home');
    }
}
