@extends('layouts.questions')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('cart.paymentPageTitle') }}</h1>
    </div>
    
    <div class="row">
        <div class="layout-largerProfileContainer">
            <div class="card-wrapper" style="margin-top: 30px;"></div>
            <form class="form" id="payment-form" action="/account/checkout/payment" method="post" style="max-width: 350px; margin: 30px auto 0;">
                {{ csrf_field() }}
                <div class="form-errors"></div>

                <div class="form-group">
                    <label for="cardNumberField">{{ trans('cart.cardNumber') }}</label>
                    <input class="form-control js-cardNumber" id="cardNumberField" type="text" size="20" data-stripe="number">
                </div>

                <div class="row">
                    <div class="col-xs-6 form-group">
                        <label for="expirationField">{{ trans('cart.cardExpirationDate') }}</label>
                        <input class="form-control js-expiration" id="expirationField" type="text" size="2" data-stripe="expiration">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label for="cvcField">{{ trans('cart.cardCvc') }}</label>
                        <input class="form-control js-cvc" id="cvcField" type="text" size="4" data-stripe="cvc">
                    </div>
                </div>

                <div class="form-group">
                    <label for="fullnameField">{{ trans('cart.cardOwnerName') }}</label>
                    <input class="form-control js-name" id="fullnameField" type="text" size="4" data-stripe="name" value="{{ old('name', $kit->customer->name) }}">
                </div>

                <button type="submit" class="button js-submit">{{ trans('cart.confirmPayment') }}</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('{{ env('STRIPE_PUBLISHABLE') }}');

        (function ($, Stripe, undefined){
            var $form = $('#payment-form');
            
            $form.submit(function(event) {
                var expMonthAndYear = $('.js-expiration').val().split(" / ");
                // console.log(expMonthAndYear[0], expMonthAndYear[1]);
                
                $form.imarcomLoader();
                $form.find('.submit').prop('disabled', true);

                // Request a token from Stripe:
                Stripe.card.createToken({
                    number: $form.find('.js-cardNumber').val(),
                    cvc: $form.find('.js-cvc').val(),
                    exp_month: expMonthAndYear[0],
                    exp_year: expMonthAndYear[1]
                }, stripeResponseHandler);

                // Prevent the form from being submitted:
                return false;
            });

            function stripeResponseHandler(status, response) {
                // Grab the form:
                var $form = $('#payment-form');
                
                $(".form-error", $form).remove();

                if (response.error) { // Problem!
                    
                    // Show the errors on the form:
                    $form.find('.form-errors').append('<div class="form-error">'+response.error.message+'</div>');
                    $form.trigger("loader.destroy");
                    $form.find('.js-submit').prop('disabled', false); // Re-enable submission

                } else { // Token was created!

                    // Get the token ID:
                    var token = response.id;

                    // Insert the token ID into the form so it gets submitted to the server:
                    $form.append($('<input type="hidden" name="stripeToken">').val(token));

                    // Submit the form:
                    $form.get(0).submit();
                }
            };
        })(jQuery, Stripe);

        (function ($, Card, document, undefined) {

            new Card({
                form: '#payment-form',
                container: '.card-wrapper',

                messages: {
                    validDate: '{{ trans('cart.expire_date') }}',
                    monthYear: '{{ trans('cart.mm_yy') }}'
                },

                formSelectors: {
                    numberInput: '.js-cardNumber',
                    expiryInput: '.js-expiration',
                    cvcInput: '.js-cvc',
                    nameInput: '.js-name'
                },
            });
            
            var elem = document.getElementById('fullnameField');
            var event = new Event('change');
            elem.dispatchEvent(event);

        })(jQuery, Card, document);
    </script>
@endpush