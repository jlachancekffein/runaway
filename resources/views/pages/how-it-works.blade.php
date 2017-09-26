@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('howItWorks.title') }}</h1>
    </div>
</div>

<div class="layout-noPaddingContainer" style="margin-bottom: 20px;">
    <div class="layout-rightLarge">
        <p class="howItWork-paragraphBlock">{{ trans('howItWorks.headerText1') }}</p>
        <p class="howItWork-paragraphBlock">{!! trans('howItWorks.headerText2') !!}</p>
        <p class="howItWork-paragraphBlock">{{ trans('howItWorks.headerText3') }}</p>
        @if (App::getLocale() == 'en')
        <p class="howItWork-paragraphBlock">{{ trans('howItWorks.headerText4') }}</p>
        @endif
    </div>
</div>

<div class="howItWork">
    <div class="howItWork-content">
        <div class="howItWork-texts">
            <img class="howItWork-number" src="/images/howItWork-step1.png" alt="1">
            <h3 class="howItWork-title">{{ trans('howItWorks.title1') }}</h3>
            <p class="howItWork-text">{{ trans('howItWorks.text1') }}</p>
        </div><?php
        ?><img class="howItWork-image" src="/images/howItWork-1.jpg" alt="">
    </div>
</div>

<div class="howItWork-odd">
    <div class="howItWork-content">
        <div class="howItWork-texts">
            <img class="howItWork-number" src="/images/howItWork-step2.png" alt="2">
            <h3 class="howItWork-title">{{ trans('howItWorks.title2') }}</h3>
            <p class="howItWork-text">{{ trans('howItWorks.text2') }}</p>
        </div><?php
        ?><img class="howItWork-image" src="/images/howItWork-2.jpg" alt="">
    </div>
</div>

<div class="howItWork">
    <div class="howItWork-content">
        <div class="howItWork-texts">
            <img class="howItWork-number" src="/images/howItWork-step3.png" alt="3">
            <h3 class="howItWork-title">{{ trans('howItWorks.title3') }}</h3>
            <p class="howItWork-text">{{ trans('howItWorks.text3') }}</p>
        </div><?php
        ?><img class="howItWork-image" src="/images/howItWork-3.jpg" alt="">
    </div>
</div>

<div class="howItWork-buttons">
    <a class="howItWork-button" href="{{ url('/register/') }}">{{ trans('howItWorks.link1') }}</a>
    <a class="howItWork-button" href="{{ url('/returns-exchanges/') }}">{{ trans('howItWorks.link2') }}</a>
    <a class="howItWork-button" href="{{ url('/faq/') }}">{{ trans('howItWorks.link3') }}</a>
    
    <p class="howItWork-paragraphBlock">{!! trans('howItWorks.questionContact') !!}</p>
    <p class="howItWork-paragraphBlock">
        <a href="mailto:{{ trans('general.r2dEmail') }}">{{ trans('general.r2dEmail') }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php
        ?><a href="tel:{{ trans('howItWorks.phone') }}">{{ trans('howItWorks.phoneVisible') }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php
        ?><a href="{{ trans('general.facebook') }}" target="_blank">{{ trans('howItWorks.facebookVisible') }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php
        ?><a href="{{ trans('general.instagram') }}" target="_blank">{{ trans('howItWorks.instagramVisible') }}</a>
    </p>
</div>

@endsection