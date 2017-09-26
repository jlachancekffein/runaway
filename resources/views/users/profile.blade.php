@extends('layouts.internal-pages')

@section('content')
    <div class="layout-container">
        <div class="layout-leftPadding">
            @if ($user == 'admin')
                <h1 class="mainTitle">{{ trans('account.adminSpace') }}</h1>
            @else
                <h1 class="mainTitle">{{ trans('account.myProfile') }}</h1>
            @endif
        </div>
        
        <div class="row">
            <div class="layout-profileContainer">
                @if ($user == 'admin')
                    <ul class="profile-menu">
                        <li><a class="button" href="{{ url('/admin/kits') }}">{{ trans('account.kitRequests') }}</a></li>
                        <li><a class="button" href="{{ url('/admin/orders/post_canada/export.csv') }}">Exporter les adresses pour Poste Canada</a></li>
                        <li><a class="button" href="{{ url('/admin/articles/blog') }}">{{ trans('account.blogs') }}</a></li>
                        <li><a class="button" href="{{ url('/admin/articles/lookbook') }}">{{ trans('account.lookbook') }}</a></li>
                        <li><a class="button" href="{{ url('/admin/taxes') }}">{{ trans('account.taxes') }}</a></li>
                        @if (Auth::user()->password)
				<li><a class="button" href="{{ url('/account/change-password') }}">{{ trans('account.changePassword') }}</a></li>
			@endif
                    </ul>
                @else
                    <ul class="profile-menu">
                        <li><a class="button" href="{{ url('account/kit-request') }}">{{ trans('account.kitRequest') }}</a></li>
                        <?php /*<li><a class="button" href="{{ url('account/kits') }}">Mes kits à confirmer</a></li>*/ ?>
                        <?php /*<li><a class="button" href="#">Historique des commandes</a></li>*/ ?>
                        <li><a class="button" href="{{ url('/account/question/1/?modify=1') }}">{{ trans('account.changePreferences') }}</a></li>
                        <li><a class="button" href="{{ url('/account/address-book') }}">{{ trans('account.addressBook') }}</a></li>
                        <?php /*<li><a class="button" href="{{ url('/account/question/10/?modify=1') }}">{{ trans('account.changeAddress') }}</a></li>*/ ?>
			@if (Auth::user()->password)
                        	<li><a class="button" href="{{ url('/account/change-password') }}">{{ trans('account.changePassword') }}</a></li>
			@endif
                    </ul>

                    @if (count($kits) > 0)
                        <h2 class="smallMainTitle" style="margin-top: 50px;">{{ trans('account.myKits') }}</h2>
                        @include('partials.kitsList')
                    @endif

                    @if (count($payedKits) > 0)
                        <h2 class="smallMainTitle" style="margin-top: 50px;">{{ trans('account.kitHistory') }}</h2>
                        @include('partials.payedKitsList')
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
