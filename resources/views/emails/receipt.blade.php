@extends('layouts.emails')

@section('title')
{{ trans('cart.emailTitle', compact('kitName')) }}
@endsection

@section('content')

<tr>
    <td style="padding-bottom: 20px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.emailText') }}</td>
</tr>

<tr>
    <td style="padding-bottom: 30px;"><table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.emailNameField') }}</td>
            <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $customerName ?></td>
        </tr>
        <tr>
            <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.emailDateField') }}</td>
            <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $transactionDate ?></td>
        </tr>
        <tr>
            <td style="padding: 8px; width: 135px; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.emailKitField') }}</td>
            <td style="padding: 8px; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $kitName ?></td>
        </tr>
    </table></td>
</tr>

<tr>
    <td style="border-top: 1px solid #cecece; border-left: 1px solid #cecece; border-right: 1px solid #cecece; padding: 8px; text-align: center; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.emailConfirmationNumber') }}</td>
</tr>
<tr>
    <td style="border-bottom: 1px solid #cecece; border-left: 1px solid #cecece; border-right: 1px solid #cecece; padding: 8px; text-align: center; font-size: 16px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $transactionId ?></td>
</tr>

<tr>
    <td style="padding-top: 30px;"><table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <th style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.item') }}</th>
            <th style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.emailBrandField') }}</th>
            <th style="width: 80px; padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</th>
            <th style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.price') }}</th>
        </tr>
        <?php
        foreach ($products as $product) {
        ?>
        <tr>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $product['name'] ?></td>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= $product['brand'] ?></td>
            <td style="width: 80px; padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; color: #000; font-family: Arial, Helvetica, sans-serif;">
                <?php
                if (array_key_exists('reduced_price', $product) && $product['reduced_price'] > 0) {
                    ?><span style="text-decoration: line-through;"><?= money_format('%n', $product['regular_price']) ?></span> <?= money_format('%n', $product['reduced_price']) ?><?php
                } else {
                    ?>$<?= $product['regular_price'] ?><?php
                }
                ?>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="width: 80px; padding: 5px; border-bottom: 1px solid #cecece; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.subtotal') }}</td>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= money_format('%n', $subtotal) ?></td>
        </tr>
        @if ($expressShipping)
        <tr>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="width: 80px; padding: 5px; border-bottom: 1px solid #cecece; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.expressShipping') }}</td>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ money_format('%n', $expressShipping) }}</td>
        </tr>
        @else
        <tr>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="width: 80px; padding: 5px; border-bottom: 1px solid #cecece; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.shipping') }}</td>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ money_format('%n', config('ecommerce.shipping_cost')) }}</td>
        </tr>
        @endif
        <?php
        foreach ($taxes as $taxKey => $tax) {
        ?>
        <tr>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="width: 80px; padding: 5px; border-bottom: 1px solid #cecece; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= trans('cart.' . $taxKey) ?></td>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= money_format('%n', $tax) ?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="padding: 5px; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
            <td style="width: 80px; padding: 5px; border-bottom: 1px solid #cecece; text-align: right; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;">{{ trans('cart.total') }}</td>
            <td style="padding: 5px; border-bottom: 1px solid #cecece; text-align: left; font-size: 15px; font-weight: 600; color: #000; font-family: Arial, Helvetica, sans-serif;"><?= money_format('%n', $total) ?></td>
        </tr>
    </table></td>
</tr>
<tr>
    <td style="padding-top: 80px;"><table cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td style="padding: 0 10px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
                <a href="{{ trans('general.facebook') }}"><img style="display: block; border: 0;" src="{{ asset('images/mailsFacebook.jpg') }}" alt="Facebook"></a>
            </td>
            <td style="padding: 0 10px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
                <a href="{{ trans('general.instagram') }}"><img style="display: block; border: 0;" src="{{ asset('images/mailsInstagram.jpg') }}" alt="Instagram"></a>
            </td>
        </tr>
    </table></td>
</tr>
<tr>
    <td style="text-align: center; padding-top: 15px; font-size: 16px; font-family: Arial, Helvetica, sans-serif;">
        {{ trans('contact.address') }}, {{ trans('contact.city') }}<br>
        {{ trans('contact.callUs') }} <a style="color: #c09e7a; text-decoration: underline;" href="tel:{{ trans('contact.tollFreeNumber') }}">{{ trans('contact.tollFreeNumber') }}</a>
    </td>
</tr>

@endsection