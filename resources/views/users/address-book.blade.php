@extends('layouts.internal-pages')

@section('content')
<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle" style="margin-bottom: 50px;">{{ trans('account.addressBook') }}</h1>
    </div>
    
    <div class="row">
        <div class="layout-profileContainer">
            <div class="layout-row">
                <button class="profileAddress js-profileAddress" data-id="contact">
                    <div class="js-profileAddress-address">{{ $preferences['address'] }}</div>
                    <div><span class="js-profileAddress-city">{{ $preferences['city'] }}</span>, <span class="js-profileAddress-province" data-province="{{ $preferences['province'] }}">{{ $provinces[$preferences['province']] }}</span></div>
                    <div class="js-profileAddress-postalCode" style="text-transform: uppercase;">{{ $preferences['postal_code'] }}</div>
                </button>
                
                @foreach ($addresses as $address)
                <button class="profileAddress js-profileAddress" data-id="{{ $address->address_id }}">
                    <div class="js-profileAddress-address">{{ $address->address }}</div>
                    <div><span class="js-profileAddress-city">{{ $address->city }}</span>, <span class="js-profileAddress-province" data-province="{{ $address->province }}">{{ $provinces[$address->province] }}</span></div>
                    <div class="js-profileAddress-postalCode" style="text-transform: uppercase;">{{ $address->postal_code }}</div>
                </button>
                @endforeach
            </div>
            
            <div style="margin-bottom: 30px;">
                <button class="button js-profileAddAddress">{{ trans('account.addAddress') }}</button>
            </div>
            
            <form class="form profile-modifyAddressForm js-profile-modifyAddressForm js-ajaxForm" action="/account/address-book" method="post" onsubmit="return false;">
                {{ csrf_field() }}
                
                <div class="form-errors">
                    @if (!empty($errors))
                        @foreach ($errors->all() as $error)
                            <div class="form-error">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
                
                <div class="form-group form-field">
                    <label for="addressField">{{ trans('questions.address') }}</label>
                    <input class="form-input" id="addressField" name="address" type="text">
                </div>
                
                <div class="form-group form-field">
                    <label for="cityField">{{ trans('questions.city') }}</label>
                    <input class="form-input" id="cityField" name="city" type="text">
                </div>
                
                <div class="form-group form-field">
                    <label for="provinceField">{{ trans('questions.province') }}</label>
                    <select class="form-control js-select2" name="province" id="provinceField">
                        @foreach ($provinces as $key => $province)
                        <option value="{{ $key }}">{{ $province }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group form-field">
                    <label for="postalCodeField">{{ trans('questions.postalCode') }}</label>
                    <input class="form-input" id="postalCodeField" name="postal_code" type="text">
                </div>
                
                <input type="hidden" id="addressIdField" name="address_id" value="0">
                
                <button class="question-submit" type="submit">{{ trans('general.update') }}</button>
            </form>
        </div>
    </div>
    <a href="{{ route('profile') }}" class="form-previous">{{ trans('account.backToProfile') }}</a>
</div>
@endsection
