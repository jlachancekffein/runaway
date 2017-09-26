@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('passwords.resetPasswordPageTitle') }}</h1>
    </div>
</div>

<div class="layout-noPaddingContainer" style="margin-top: 50px;">
    <div class="col-md-6 col-md-offset-3">
        <form class="form js-ajaxForm" action="{{ url('/password/reset') }}" method="post" onsubmit="return false;">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="form-field">
                <input class="form-input" type="text" name="email" placeholder="{{ trans('general.emailAddress') }}" value="{{ $email or old('email') }}">
            </div>
            
            <div class="form-field">
                <input class="form-input" type="password" name="password" placeholder="{{ trans('general.password') }}">
            </div>
            
            <div class="form-field">
                <input class="form-input" type="password" name="password_confirmation" placeholder="{{ trans('general.confirmPassword') }}">
            </div>
            
            <div class="form-field">
                <button type="submit" class="form-submitButton">{{ trans('passwords.resetPasswordPageButton') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
