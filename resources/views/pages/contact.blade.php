@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{!! trans('contact.pageTitle') !!}</h1>
        <p class="lead-bold">{{ trans('contact.pageSubtitle') }}</p>
    </div>
</div>

<div class="layout-noPaddingContainer">
    <div class="layout-imageFormImage">
        <img style="width: 100%;" src="/images/contact.jpg" alt="">
    </div><?php
    
    ?><div class="layout-imageFormForm">
        <form class="form js-ajaxForm" action="{{ URL::current() }}" method="post" onsubmit="return false;">
            {{ csrf_field() }}
            
            <div class="form-title">{{ trans('contact.formTitle') }}</div>
            <div class="form-field">
                <input class="form-input" type="text" name="name" placeholder="{{ trans('contact.formNameField') }}">
            </div>
            <div class="form-field">
                <input class="form-input" type="text" name="email" placeholder="{{ trans('contact.formEmailField') }}">
            </div>
            <div class="form-field">
                <input class="form-input" type="text" name="phone" placeholder="{{ trans('contact.formPhoneField') }}">
            </div>
            <div class="form-field">
                <textarea class="form-input" name="message" placeholder="{{ trans('contact.formMessageField') }}"></textarea>
            </div>
            <div class="form-field">
                <button type="submit" class="form-submitButton">{{ trans('contact.formSubmit') }}</button>
            </div>
        </form>
        <div class="form-success">{!! trans('contact.formSuccess') !!}</div>
    </div>
</div>

<div class="contact">
    <div class="contact-title">Runway 2 Doorway</div>
    
    <div class="contact-coordinates">
        <div class="contact-addressTitle">{{ trans('contact.addressName') }}</div>
        <div class="contact-addressLineOne">{{ trans('contact.address') }}</div>
        <div class="contact-addressLineTwo">{{ trans('contact.cityOnly') }}<br>{{ trans('contact.postalCode') }}</div>
    </div>
    
    <div class="contact-phone">
        <div class="contact-phoneText">{{ trans('contact.callUs') }}</div>
        <div class="contact-phoneNumber"><a href="tel:{{ trans('contact.tollFreeHref') }}">{!! trans('contact.tollFree') !!}</a></div>
    </div>
</div>

@endsection