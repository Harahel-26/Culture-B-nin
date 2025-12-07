<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\MessageContact;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.pages.contact');
    }

    public function send(Request $request)
    {
        // Validation
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Sauvegarde en DB
        MessageContact::create($data);

        // (OPTIONNEL) Envoi mail au staff
        try {
            Mail::raw("Message reçu de {$data['name']} ({$data['email']}):\n\n{$data['message']}", function ($m) {
                $m->to('support@culturebenin.com')->subject('Nouveau message via Contact');
            });
        } catch (\Exception $e) {
            // pas de crash si mail non configuré
        }

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons bientôt !');
    }
}
