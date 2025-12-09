@component('mail::message')
# Nouveau message de contact

**Nom :** {{ $contact->nom }}  
**Téléphone :** {{ $contact->telephone }}  
@if($contact->email) **Email :** {{ $contact->email }}  @endif
**Sujet :** {{ $contact->sujet }}

---

{{ $contact->message }}

@component('mail::panel')
Envoyé le {{ $contact->created_at->format('d/m/Y H:i') }}
@endcomponent

Merci,  
{{ config('app.name') }}
@endcomponent