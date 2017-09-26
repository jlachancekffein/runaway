@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('kits.kitTitle') }}</h1>
        
        @if ($kit->status != 'sold')
        <div class="kits-date" style="margin-bottom: 20px;">{{ trans('kits.limitDate') . trans('general.:') . ' ' . date('Y-m-d', strtotime($kit->expire_at)) }}</div>
        @endif
    </div>
    
    <div class="row">
        <div class="layout-largerProfileContainer">
            
            <div class="form-errors">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="form-error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            
            @if (!empty($kit->kitRequest))
                <h2 class="sectionTitle">{{ $kit->kitRequest->name }}</h2>
            @endif
            
            @if (!empty($kit->transaction->tracking_number))
            <p class="lead">{{ trans('kits.tracking') . trans('general.:') }} <a style="text-decoration: underline;" href="{{ trans('kits.tracking_link', ['number' => $kit->transaction->tracking_number]) }}" target="_blank">{{ $kit->transaction->tracking_number }}</a></p>
            @endif

            <div class="kits-photoContainer">
                <img class="kits-photo" src="{{ asset("storage/$kit->photo") }}">
                @foreach ($products as $product)
                    <div class="marker js-accountMarker" style="top: {{ $product->marker_y }}; left: {{ $product->marker_x }};">
                        <a class="marker-toggle js-accountMarker-toggleDetails">
                            <img src="/img/tag.png" alt="Marker" class="marker-pin">
                        </a>
                        <div class="marker-details">
                            <h3 class="lead-bold">{{ $product->name }}<br>{{ $product->brand }}</h3>
                            @if ($product->reduced_price > 0)
                            <p><del>{{ money_format('%n', $product->regular_price) }}</del> <strong class="js-cart-price">{{ money_format('%n', $product->reduced_price) }}</strong></p>
                            @else
                            <p><strong class="js-cart-price">{{ money_format('%n', $product->regular_price) }}</strong></p>
                            @endif
                            @if ($kit->status != 'sold')
                            <a class="btn btn-danger js-removeProduct" data-product-id="{{ $product->id }}">{{ trans('cart.removeFromOrder') }}</a>
                            <a class="btn btn-default js-addProduct" style="display: none;" data-product-id="{{ $product->id }}">{{ trans('cart.addToOrder') }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <h2 class="sectionTitle">{{ trans('cart.anOrder') }}</h2>
            @if (count($products) > \App\Http\Controllers\Account\KitsController::BUYABLE_ITEM_QUANTITY)
                <p>{{ trans_choice('kits.productLimit', \App\Http\Controllers\Account\KitsController::BUYABLE_ITEM_QUANTITY, ['quantity' => \App\Http\Controllers\Account\KitsController::BUYABLE_ITEM_QUANTITY]) }}</p>
            @endif
            <table class="table cart">
                <thead>
                    <tr>
                        <th>{{ trans('cart.item') }}</th>
                        <th></th>
                        <th></th>
                        <th>{{ trans('cart.price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr id="product{{ $product->id }}" class="cart-productLine js-productLine">
                            <td class="cart-productName"><strong>{{ $product->name }}</strong><br>{{ $product->brand }}</td>
                            <td class="cart-productActions">
                                @if ($kit->status != 'sold')
                                <a class="btn btn-danger js-removeProduct" data-product-id="{{ $product->id }}">{{ trans('cart.removeFromOrder') }}</a>
                                <a class="btn btn-default js-addProduct" style="display: none;" data-product-id="{{ $product->id }}">{{ trans('cart.addToOrder') }}</a>
                                @endif
                            </td>
                            <td></td>
                            @if ($product->reduced_price > 0)
                            <td class="cart-productPrices"><del>{{ money_format('%n', $product->regular_price) }}</del> <strong class="js-cart-price" data-price="{{ $product->reduced_price }}">{{ money_format('%n', $product->reduced_price) }}</strong></td>
                            @else
                            <td class="cart-productPrices"><strong class="js-cart-price" data-price="{{ $product->regular_price }}">{{ money_format('%n', $product->regular_price) }}</strong></td>
                            @endif
                        </tr>
                    @endforeach
                    <tr class="cart-totalLine">
                        <td class="cart-emptyCell"></td>
                        <td class="cart-emptyCell"></td>
                        <td class="cart-sumLabel">{{ trans('cart.subtotal') }}</td>
                        <td class="cart-sum cart-subtotal js-cart-subtotal">
                            {{ money_format('%n', $subtotal) }}
                        </td>
                    </tr>
                    <tr class="cart-totalLine">
                        <td class="cart-emptyCell"></td>
                        <td class="cart-emptyCell"></td>
                        <td class="cart-sumLabel">{{ trans('cart.shipping') }}</td>
                        <td class="cart-sum cart-subtotal js-cart-shipping" data-price="{{ config('ecommerce.express_shipping_cost') }}">
                            {{ money_format('%n', config('ecommerce.shipping_cost')) }}
                        </td>
                    </tr>
                    <tr class="cart-totalLine">
                        <td class="cart-emptyCell"></td>
                        <td class="cart-emptyCell"></td>
                        <td class="cart-sumLabel js-cart-taxLabel">{{ trans("cart.tax_to_be_determined") }}</td>
                        <td class="cart-sum cart-tax js-cart-taxValue">
                            @if (old('shipping_address'))
                                {{--{{ money_format('%n', ($subtotal) * ->percentage) }}--}}
                            @endif
                        </td>
                    </tr>
                    <tr class="cart-totalLine">
                        <td class="cart-emptyCell"></td>
                        <td class="cart-emptyCell"></td>
                        <td class="cart-sumLabel">{{ trans('cart.total') }}</td>
                        <td class="cart-sum cart-total js-cart-total">
                            {{ money_format('%n', $subtotal) }}
                        </td>
                    </tr>
                </tbody>
            </table>

            @if ($kit->status != 'sold')
            <form class="cart-buttons" method="post" action="/account/kits/{{ $kit->id }}">
                {{ csrf_field() }}

                <div class="form-field" style="margin-bottom: 30px; text-align: left;">
                    <label class="form-label" style="margin-bottom: 10px; font-size: 20px;">
                        <input class="js-shipping-field" type="checkbox" name="express_shipping" value="1"{{ old('express_shipping') ? ' checked="checked" ' : '' }}>
                        {{ trans('cart.expressShipping') }}
                    </label>
                </div>
                
                <div class="form-field" style="margin-bottom: 30px; text-align: left;">
                    <label class="form-label" for="shippingAddressField" style="margin-bottom: 10px; font-size: 20px;">{{ trans('cart.shippingAddress') }}</label>
                    <select class="form-input js-select2 js-cart-shippingAddress" name="shipping_address" id="shippingAddressField">
                        <option value=""></option>
                        @foreach ($addresses as $address)
                            <option value="{{ $address->address_id }}" data-province="{{ $address->province }}" {{ old('shipping_address') == $address->address_id ? ' selected="selected"' : '' }}>{{
                                $address->address . ', ' . $address->city . ', ' . trans('general.' . $address->province) . ', ' . $address->postal_code
                            }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-field" style="margin-bottom: 30px; text-align: left;">
                    <label class="form-label" for="billingAddressField" style="margin-bottom: 10px; font-size: 20px;">{{ trans('cart.billingAddress') }}</label>
                    <select class="form-input js-select2" name="billing_address" id="billingAddressField">
                        <option value=""></option>
                        @foreach ($addresses as $address)
                            <option value="{{ $address->address_id }}"{{ old('billing_address') == $address->address_id ? ' selected="selected"' : '' }}>{{
                                $address->address . ', ' . $address->city . ', ' . trans('general.' . $address->province) . ', ' . $address->postal_code
                            }}</option>
                        @endforeach
                    </select>
                </div>
                
                <a href="{{ url('/account/address-book/') }}" style="float: left;">{{ trans('account.addAddress') }}</a>
            
                @foreach ($products as $product)
                    <input class="js-productInput" type="hidden" name="product[{{ $product->id }}]" value="1">
                @endforeach
                <button class="button" type="submit">{{ trans('cart.toOrder') }}</button>
            </form>
            @endif
        </div>
    </div>
    <a href="{{ route('profile') }}" class="form-previous">{{ trans('account.backToProfile') }}</a>
</div>

<script>
    var taxes = {
        @foreach ($provinces as $province)
        "{{ $province->key }}": {!! $province->taxes->pluck('percentage', 'key')->filter() !!},
        @endforeach
    };
</script>
@endsection

@push('scripts')
<script type="text/javascript">
    $(".js-accountMarker").addClass('animated swing').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
        $(this).removeClass('animated swing');
    });
</script>
@endpush
