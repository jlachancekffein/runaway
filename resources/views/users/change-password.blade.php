@extends('layouts.internal-pages')

@section('content')
    <div class="layout-container">
        <div class="layout-leftPadding">
            <h1 class="mainTitle">{{ trans('passwords.changePasswordPageTitle') }}</h1>
        </div>
        
        <div class="row">
            <div class="layout-profileContainer">
                <form class="profile-form js-ajaxForm form form-profile" method="post" action="{{ url()->current() }}" onsubmit="return false;">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    
                    <div class="form-errors">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="form-error">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                    
                    <?php /*
                    <div class="form-field">
                        <label class="form-label" for="name">{{ trans('passwords.name') }}</label>
                        <input type="text" class="form-input" name="name" id="nameField" value="{{ old('name', Auth::user()->name) }}">
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="emailField">{{ trans('passwords.email') }}</label>
                        <input type="email" class="form-input" name="email" id="emailField" value="{{ old('email', Auth::user()->email) }}">
                    </div>
                    */ ?>
                    @if (Auth::user()->password)
                        <div class="form-field">
                            <label class="form-label" for="passwordField">{{ trans('passwords.currentPassword') }}</label>
                            <input type="password" class="form-input" name="password" id="passwordField">
                        </div>
                        <div class="form-field">
                            <label class="form-label" for="newPasswordField">{{ trans('passwords.newPassword') }}</label>
                            <input type="password" class="form-input" name="new_password" id="newPasswordField">
                        </div>
                        <div class="form-field">
                            <label class="form-label" for="newPasswordConfirmationField">{{ trans('passwords.newPasswordConfirmation') }}</label>
                            <input type="password" class="form-input" name="new_password_confirmation" id="newPasswordConfirmationField">
                        </div>
                    @endif
                    <button class="form-submitButton" type="submit">{{ trans('passwords.save') }}</button>
                </form>
                <div class="form-success">
                    <p>{{ trans('passwords.changePasswordSuccess') }}</p>
                </div>
            </div>
        </div>
        <a href="{{ route('profile') }}" class="form-previous">{{ trans('account.backToProfile') }}</a>
    </div>
@endsection
