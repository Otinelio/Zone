@component('mail::message')
# Nouvel abonné à la newsletter

**Email :** {{ $email }}

@component('mail::panel')
Inscription le {{ now()->format('d/m/Y H:i') }}
@endcomponent

Merci.
@endcomponent