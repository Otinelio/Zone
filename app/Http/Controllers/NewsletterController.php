<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterSubscribed;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:newsletters,email',
        ]);

        Newsletter::create($validated);

        $admin = config('mail.admin_address') ?? env('MAIL_ADMIN_ADDRESS');

        if ($admin) {
            Mail::to($admin)->send(new NewsletterSubscribed($validated['email']));
            // ->queue(...) si tu veux
        }

        return back()->with('success', 'Inscription réussie. Merci de vous être abonné.');
    }
}
