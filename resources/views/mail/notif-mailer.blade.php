<x-mail::message>
Bonjour cher {{ $user->getFullname()}},

Nous vous informons du changement de statut de votre incident #{{ $incident->id }} <br>
Pour le compte de {{ $incident->departement->service->nom}}({{$incident->departement->ville->nom}})

Le statut actuel de l'incident est
<x-mail::button :url="route('citoyen.dashboard')">
{{ $incident->statut->nom }}
</x-mail::button>

Cordialement,<br>
{{ $incident->departement->service->nom}}({{$incident->departement->ville->nom}}) via
{{ config('app.name') }}
</x-mail::message>
