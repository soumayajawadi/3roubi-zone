<x-mail::message>
# {{ __('Merci pour votre commande !') }}

{{ __('Bonjour') }} {{ $order->user->name }},

{{ __('Votre commande') }} **#{{ $order->id }}** {{ __('a bien été enregistrée.') }}

<x-mail::table>
| {{ __('Produit') }} | {{ __('Qté') }} | {{ __('Prix') }} |
|:--------|:---:|--------:|
@foreach($order->items as $item)
| {{ $item->product->name ?? '-' }} | {{ $item->quantity }} | {{ number_format($item->unit_price * $item->quantity, 2) }} € |
@endforeach
</x-mail::table>

**{{ __('Total') }} : {{ number_format($order->total, 2) }} €**

{{ __('Adresse de livraison') }} :
{{ $order->shipping_address }}

<x-mail::button :url="route('orders.my')">
{{ __('Voir mes commandes') }}
</x-mail::button>

{{ __('Merci') }},<br>
3roubi Zone
</x-mail::message>