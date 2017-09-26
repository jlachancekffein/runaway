@extends('layouts.internal-pages')

@section('content')

<div class="layout-container" style="margin-bottom: 20px;">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('stylism.mainTitle') }}</h1>
    </div>
</div>

<div class="layout-container">
    <div class="layout-rightLessLarge">
        <p>{{ trans('stylism.intro') }}</p>
        <p><strong>{{ trans('stylism.title1') }}</strong></p>
        <p>{{ trans('stylism.text1') }}</p>
        <p>{{ trans('stylism.list1Title') }}</p>
        <ul>
            <li>{{ trans('stylism.list1Element1') }}</li>
            <li>{{ trans('stylism.list1Element2') }}</li>
            <li>{{ trans('stylism.list1Element3') }}</li>
            <li>{{ trans('stylism.list1Element4') }}</li>
        </ul>
        <p><strong>{{ trans('stylism.title2') }}</strong></p>
        <p>{{ trans('stylism.text2') }}</p>
        <p>{{ trans('stylism.list2Title') }}</p>
        <ul>
            <li>{{ trans('stylism.list2Element1') }}</li>
            <li>{{ trans('stylism.list2Element2') }}</li>
            <li>{{ trans('stylism.list2Element3') }}</li>
            <li>{{ trans('stylism.list2Element4') }}</li>
            <li>{{ trans('stylism.list2Element5') }}</li>
        </ul>
        <p><strong>{{ trans('stylism.title3') }}</strong></p>
        <p>{{ trans('stylism.text3') }}</p>
        {!! trans('stylism.text4') !!}

        <form class="form js-ajaxForm" action="/contact/" method="post" onsubmit="return false;" style="margin-top: 30px;">
            {{ csrf_field() }}
            
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

@endsection