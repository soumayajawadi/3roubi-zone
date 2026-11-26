<x-mail::message>
# Bonjour {{ $order->user->name }},

Nous avons bien reçu votre commande **#{{ $order->id }}** d'un montant de **{{ number_format($order->total, 2) }} €**.

Merci pour votre confiance !

<x-mail::button :url="route('orders.my')">
Voir ma commande
</x-mail::button>

L'équipe de 3roubi Zone.
</x-mail::message>