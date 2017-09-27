<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @section('meta')
    <meta name="description" content="Runway 2 Doorway">
    <meta name="keywords" content="Runway 2 Doorway">
    @endsection
    
    @yield('meta')

    <title>Runway 2 Doorway</title>

    <!-- Fonts -->
    <script src="https://use.fontawesome.com/cf4b70563c.js"></script>
    <?php /*<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">*/ ?>
    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <script>
        var baseUrl = '{{ env('APP_URL') }}';
        var availableLocales = {!! json_encode(config('app.available_locales')) !!};
        var translations = {
            tax_qst: '{{ trans('cart.tax_qst') }}',
            tax_gst: '{{ trans('cart.tax_gst') }}',
            tax_hst: '{{ trans('cart.tax_hst') }}',
            tax_pst: '{{ trans('cart.tax_pst') }}'
        };
        var shipping_cost = {{ config('ecommerce.shipping_cost') }};
    </script>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#000000">

    <meta property="og:title" content="{{ trans('home.ogTitle') }}">
    <meta property="og:description" content="{{ trans('home.ogDescription') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:image" content="{{ env('APP_URL') }}/images/logo-1024x1024.png">
</head>
<body id="app-layout" data-language="{{ App::getLocale() }}">
    
    @include('partials.header')
    
    @yield('subheader')
    @yield('content')
    @yield('helpContact')
    
    @include('partials.modals')
    
    @include('partials.footer')
    
    @if (array_key_exists('message', $_GET))
    <div class="modal fade" id="modal-randomMessage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>x</span></button>
                    <div class="modal-title">{{ trans('general.genericMessageTitle') }}</div>
                </div>
                <div class="modal-body">
                    <p style="font-size: 16px;">{{ $_GET['message'] }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- JavaScripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
    <script type="text/javascript">
@if (App::getLocale() == 'fr')
        // 1 234,56 $
        accounting.settings.currency = {
            symbol: "$",
            format: "%v %s",
            decimal: ",",
            thousand: " ",
            precision: 2
        };
@else
        // $1,234.56
        accounting.settings.currency = {
            symbol: "$",
            format: "%s%v",
            decimal: ".",
            thousand: ",",
            precision: 2
        };
@endif
    </script>
    @stack('scripts')
    
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-27352958-52', 'auto');
    ga('send', 'pageview');

    </script>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
    <script>
        /**
         To customize your embedded form validation messages, place this code before the closing script tag.
         */
        $.extend($.validator.messages, {
            required: "{{ trans('mailchimp.validation.required') }}",
            remote: "{{ trans('mailchimp.validation.remote') }}",
            email: "{{ trans('mailchimp.validation.email') }}",
            url: "{{ trans('mailchimp.validation.url') }}",
            date: "{{ trans('mailchimp.validation.date') }}",
            dateISO: "{{ trans('mailchimp.validation.dateISO') }}",
            number: "{{ trans('mailchimp.validation.number') }}",
            digits: "{{ trans('mailchimp.validation.digits') }}",
            creditcard: "{{ trans('mailchimp.validation.creditcard') }}",
            equalTo: "{{ trans('mailchimp.validation.equalTo') }}",
            accept: "{{ trans('mailchimp.validation.accept') }}",
            maxlength: $.validator.format("{{ trans('mailchimp.validation.maxlength') }}"),
            minlength: $.validator.format("{{ trans('mailchimp.validation.minlength') }}"),
            rangelength: $.validator.format("{{ trans('mailchimp.validation.rangelength') }}"),
            range: $.validator.format("{{ trans('mailchimp.validation.range') }}"),
            max: $.validator.format("{{ trans('mailchimp.validation.max') }}"),
            min: $.validator.format("{{ trans('mailchimp.validation.min') }}"),
            mc_birthday: "{{ trans('mailchimp.validation.mc_birthday') }}",
            mc_date: "{{ trans('mailchimp.validation.mc_date') }}",
            mc_phone: "{{ trans('mailchimp.validation.mc_phone') }}",
        });
    </script>
    <script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
</body>
</html>
