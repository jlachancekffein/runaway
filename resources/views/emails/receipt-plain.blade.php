{{ trans('cart.emailTitle', compact('kitName')) }}

{{ trans('cart.emailText') }}

{{ trans('cart.emailNameField') }}
<?= $customerName ?>


{{ trans('cart.emailDateField') }}
<?= $transactionDate ?>


{{ trans('cart.emailKitField') }}
<?= $kitName ?>


{{ trans('cart.emailConfirmationNumber') }}
<?= $transactionId ?>


{{ trans('cart.item') }}
{{ trans('cart.emailBrandField') }}
{{ trans('cart.price') }}

@foreach ($products as $product)
    {{ $product['name'] }}
    {{ $product['brand'] }}

    @if (array_key_exists('reduced_price', $product) && $product['reduced_price'] > 0)
        {{ trans('cart.priceWas') .' '. money_format('%n', $product['reduced_price']) }}
        {{ trans('cart.priceIs') .' '. money_format('%n', $product['regular_price']) }}
    @else
        {{ money_format('%n', $product['regular_price']) }}
    @endif
@endforeach

{{ trans('cart.subtotal') }}
<?= money_format('%n', $subtotal) ?>


<?php
foreach ($taxes as $taxKey => $tax) {
    echo trans('cart.' . $taxKey) . "\n";
    echo money_format('%n', $tax) . "\n";
    
    echo "\n";
}
?>


{{ trans('cart.total') }}
<?= money_format('%n', $total) ?>


Facebook
{{ trans('general.facebook') }}

Instagram
{{ trans('general.instagram') }}


{{ trans('contact.address') }}, {{ trans('contact.city') }}

{{ trans('contact.callUs') }} {{ trans('contact.tollFreeNumber') }}
