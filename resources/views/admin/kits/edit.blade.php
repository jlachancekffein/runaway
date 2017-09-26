@extends('layouts.internal-pages')

@section('content')

    <div class="layout-container">
        <h1 class="mainTitle">{!! trans('kits.userKit', ['name' => isset($kit->customer->name) ? $kit->customer->name : '<em>inconnu</em>']) !!}</h1>
        <form class="kits-form" action="/admin/kits/{{ $kit->id }}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="form-errors">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="form-error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>

            @if (!empty($kit->kitRequest))
                <input type="hidden" name="kit_request_id" value="{{ $kit->kit_request_id }}">
                <input type="hidden" name="customer_id" value="{{ $kit->customer_id }}">
            @endif

            <div class="adminForm-group">
                <label class="kits-label" for="customerField">{{ trans('kits.customerLabel') }}</label>
                @if ($kit->kitRequest)
                    <p>
                        <strong>{{ trans('kits.name') . trans('general.:') }} </strong><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kit->customer->id) }}">{{ $kit->customer->name }}</a><br>
                        <strong>{{ trans('kits.email') . trans('general.:') }} </strong>{{ $kit->customer->email }}<br>
                        <strong>{{ trans('kits.kitName') . trans('general.:') }} </strong>{{ $kit->kitRequest->name }}<br>
                        <strong>{{ trans('kits.budget') . trans('general.:') }} </strong>{{ trans("kitRequests.{$kit->kitRequest->budget}") }}<br>
                        @if($kit->status == 'sold')
                        <strong>{{ trans('kits.shippingAddress') . trans('general.:') }} </strong>{{
                            $shippingAddress['address'] . ', ' . $shippingAddress['city'] . ', ' . trans('general.' . $shippingAddress['province']) . ', ' . $shippingAddress['postal_code']
                        }}
                        @endif
                        @if (!empty($kit->kitRequest->comment))
                            <br>
                            <strong>{{ trans('kits.additionalInformations') . trans('general.:') }} </strong>{{ $kit->kitRequest->comment }}
                        @endif
                    </p>
                @else
                    <select class="js-memberSearch form-control" id="customerField" name="customer_id" placeholder="{{ trans('kits.selectUser') }}">
                        @if (!empty($kit->customer))
                            <option value="{{ $kit->customer_id }}">{{ $kit->customer->name }}</option>
                        @endif
                    </select>
                @endif
            </div>

            <div class="adminForm-group kits-photoContainer js-kits-photoContainer">
                <label class="kits-label" for="photoField" style="display: none;">{{ trans('kits.photoLabel') }}</label>
                <input class="kits-photoInput js-kits-photoInput" id="photoField" name="photo" type="file" style="display: none;">
                <img class="kits-photo js-kits-photo" src="{{ asset("storage/$kit->photo") }}">
            </div>
            
            @if($kit->status == 'sold')
            <h2 class="tinyMainTitle" style="margin-top: 20px; margin-bottom: 20px;">Produits vendus</h2>
            <table class="productsList" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <th>{{ trans('orders.productName') }}</th>
                    <th>{{ trans('orders.brand') }}</th>
                    <th>{{ trans('orders.price') }}</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px;">{{ $product->name }}</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px;">{{ $product->brand }}</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px;">
                        @if ($product->reduced_price != 0)
                        <span style="text-decoration: line-through;">{{ money_format('%n', $product->regular_price) }}</span> {{ money_format('%n', $product->reduced_price) }}
                        @else
                        {{ money_format('%n', $product->regular_price) }}
                        @endif
                        <input type="hidden" name="product[id][]" value="{{ $product->id }}">
                        <input type="hidden" name="product[brand][]" value="{{ $product->brand }}">
                        <input type="hidden" name="product[name][]" value="{{ $product->name }}">
                        <input type="hidden" name="product[regular_price][]" value="{{ $product->regular_price }}">
                        <input type="hidden" name="product[reduced_price][]" value="{{ $product->reduced_price }}">
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>&nbsp;</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px; padding-right: 10px; text-align: right;">{{ trans('cart.subtotal') }}</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px;"><strong>{{ money_format('%n', $subtotal) }}</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px; padding-right: 10px; text-align: right;">{{ trans('cart.shipping') }}</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px;"><strong>{{ money_format('%n', $shipping) }}</strong></td>
                </tr>
                @foreach ($taxes as $tax_name => $tax_value)
                <tr>
                    <td>&nbsp;</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px; padding-right: 10px; text-align: right;">{{ $tax_name }}</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px;"><strong>{{ money_format('%n', $tax_value) }}</strong></td>
                </tr>
                @endforeach
                <tr>
                    <td>&nbsp;</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px; padding-right: 10px; text-align: right;">{{ trans('cart.total') }}</td>
                    <td style="border-bottom: 1px solid #bbb; padding-bottom: 2px; padding-top: 10px;"><strong>{{ money_format('%n', $total) }}</strong></td>
                </tr>
            </table>
            @endif
            
            @if($kit->status != 'sold')
            <label class="kits-label" for="photoField">Téléversez une nouvelle photo</label>
            @endif
            
            <div class="adminForm-group"{!! $kit->status == 'sold' ? ' style="display: none;"' : '' !!}>
                <label for="statusField">{{ trans('kits.status') }}</label>
                <select class="form-control js-kits-status" name="status" id="statusField">
                    @foreach($actions as $statusKey)
                        <option value="{{ $statusKey }}" {!! $kit->status === $statusKey ? 'selected="selected"' : '' !!}>{{ trans('kits.action-' . $statusKey) }}</option>
                    @endforeach
                </select>
            </div>

            @if($kit->status == 'sold')
            <div class="adminForm-group">
                <label for="tracking">{{ trans('kits.tracking') }}</label>
                <input class="form-control" name="tracking" type="text">
            </div>
            @endif

            <div class="adminForm-group">
                @if($kit->status == 'sold')
                <button type="submit" class="question-submit js-kits-submitButton">{{ trans('kits.ship') }}</button>
                @else
                <button type="submit" class="question-submit js-kits-submitButton">{{ trans('kits.submitButton') }}</button>
                @endif
            </div>
        </form>
    </div>
@if($kit->status != 'draft')
<style>
    .kits-photoContainer:after {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }
</style>
@endif
@endsection

@if($kit->status != 'sold')
@push('scripts')
    <script type="text/template" id="markerTemplate">
        @include('admin.partials.marker', ['update' => true])
    </script>
    <script type="text/javascript">
        var Marker = window.Marker;
        @foreach ($products as $product)
            (new Marker("{{ $product->marker_x }}", "{{ $product->marker_y }}")).fillForm({
                id: {{ $product->id }},
                brand: "{!! $product->brand !!}",
                name: "{!! $product->name !!}",
                regular_price: "{!! $product->regular_price > 0 ? $product->regular_price : '' !!}",
                reduced_price: "{!! $product->reduced_price > 0 ? $product->reduced_price : '' !!}"
            }).stopDragging();
        @endforeach
    </script>
@endpush
@endif
