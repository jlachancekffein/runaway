@extends('layouts.internal-pages')

@section('content')

<div class="layout-container" style="margin-bottom: 40px;">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('auth.login') }}</h1>
    </div>
</div>

<div class="layout-noPaddingContainer">
    <div class="layout-imageFormImage">
        <img style="width: 100%;" src="/images/getstarted.jpg" alt="">
    </div><?php
    
    ?><div class="layout-imageFormForm">
        <form class="form js-ajaxForm" action="/login" method="post" onsubmit="return false;"<?= array_key_exists('request', $_GET) && $_GET['request'] != '' ? ' data-redirect="/'.$_GET['request'].'"' : '' ?>>
            {{ csrf_field() }}
            <div class="form-field">
                <a class="button-facebook" href="{{ url('/login/facebook') }}">{!! trans('auth.loginFacebook') !!}</a><?php
                ?><a class="button-google" href="{{ url('/login/google') }}">{!! trans('auth.loginGoogle') !!}</a>
            </div>
            <div class="form-createAccountSubtitle">{{ trans('auth.loginEmail') . trans('general.:') }}</div>
            <div class="form-field">
                <input class="form-input" type="text" name="email" placeholder="{{ trans('general.emailAddress') }}">
            </div>
            <div class="form-field">
                <input class="form-input" type="password" name="password" placeholder="{{ trans('general.password') }}">
            </div>
            <div class="form-field">
                <a class="form-forgotPassword" href="javascript:;" data-toggle="modal" data-target="#modal-forgotPassword">{{ trans('passwords.forgotPassword') . trans('general.?') }}</a>
                <button type="submit" class="form-submitButton">{{ trans('auth.signin') }}</button>
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
