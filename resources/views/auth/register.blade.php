@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <div class="alreadyMember">
            <h1 class="mainTitle">{{ trans('auth.registerTitle') . trans('general.!') }}</h1>
            <p class="alreadyMember-paragraph">{{ trans('auth.alreadyMemberParagraph') }}</p>
            <div class="alreadyMember-container">
                <div class="alreadyMember-text">{{ trans('auth.alreadyMember') . trans('general.?') }}</div><?php
                ?><a class="alreadyMember-button" href="javascript:;" data-toggle="modal" data-target="#modal-login">{!! trans('auth.signinHere') !!}</a>
            </div>
        </div>
    </div>
</div>

<div class="layout-noPaddingContainer">
    <div class="layout-imageFormImage">
        <img style="width: 100%;" src="/images/getstarted.jpg" alt="">
    </div><?php
    
    ?><div class="layout-imageFormForm">
        <form class="form js-ajaxForm" action="{{ url('/register') }}" method="post" onsubmit="return false;">
            {{ csrf_field() }}
            
            <div class="form-errors">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="form-error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            
            <div class="form-createAccountTitle">{{ trans('auth.createAccount') }}</div>
            <div class="form-field">
                <a class="button-facebook" href="{{ url('/login/facebook') }}">{!! trans('auth.loginFacebook') !!}</a><?php
                ?><a class="button-google" href="{{ url('/login/google') }}">{!! trans('auth.loginGoogle') !!}</a>
            </div>
            <div class="form-createAccountSubtitle">{{ trans('auth.loginEmail') . trans('general.:') }}</div>
            <div class="form-field">
                <input class="form-input" type="text" name="email" tabindex="1" placeholder="{{ trans('general.email') }}" value="{{ old('email') }}">
            </div>
            <div class="form-field">
                <input class="form-input" type="password" name="password" tabindex="2" placeholder="{{ trans('general.password') }}">
            </div>
            <div class="form-field">
                <input class="form-input" type="password" name="password_confirmation" tabindex="3" placeholder="{{ trans('general.confirmPassword') }}">
            </div>
            <div class="form-field">
                <button type="submit" class="form-submitButton" tabindex="5">{{ trans('auth.registerSubmit') }}</button>
            </div>
        </form>
    </div>
</div>

<div class="layout-noPaddingContainer">
    <div class="helpContact">
        <span class="helpContact-title">{{ trans('contact.needHelp') . trans('general.?') }}</span><?php
        ?> <a class="helpContact-button" href="{{ url('/contact') }}">{!! trans('contact.leaveMessage') !!}</a><?php
        ?> <span class="helpContact-smallText">{{ trans('contact.or') }}</span><?php
        ?> <a class="helpContact-button" href="{{ url('/faq') }}">{!! trans('contact.readFAQ') !!}</a>
    </div>
</div>

@endsection
