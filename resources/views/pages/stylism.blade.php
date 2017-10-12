@extends('layouts.internal-pages')

@section('content')

<div class="layout-container" style="margin-bottom: 20px;">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('stylism.mainTitle') }}</h1>
    </div>
</div>

<div class="layout-container">
    <div class="layout-leftPadding">
        <p>{{ trans('stylism.intro') }}</p>

        <div class="stylist-table">
          @foreach (['cleanup','limited','together','all_in','relooking','workplace'] as $service)
            <div class="row">
              <div class="col -icon">
                <img src="/images/stylism_{{$service}}.jpg" />
                {{ trans('stylism.'.$service.'.title') }}
              </div>
              <div class="col -content">{!! trans('stylism.'.$service.'.content') !!}</div>
              <div class="col -price">{{ trans('stylism.'.$service.'.price') }}</div>
            </div>
          @endforeach
        </div>



       
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