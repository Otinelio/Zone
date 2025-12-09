<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceived;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'       => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\s]+$/',
            'telephone' => 'nullable|string|max:20|regex:/^[0-9\s\-\+\(\)]+$/',
            'email' => 'required|email|max:255',
            'sujet'     => 'required|string',
            'message'   => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Envoi d'email à l'admin (utilise MAIL_FROM/MAIL_ADMIN dans .env)
        $admin = config('mail.admin_address') ?? env('MAIL_ADMIN_ADDRESS');

        if ($admin) {
            Mail::to($admin)->send(new ContactReceived($contact));
        }

        return back()->with('success', 'Message envoyé avec succès. Nous vous recontacterons. A bientôt ☺');
    }
}
