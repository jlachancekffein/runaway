@extends('layouts.app')

@section('helpContact')
<div class="layout-noPaddingContainer">
    <div class="helpContact">
        <span class="helpContact-title">{{ trans('contact.needHelp') . trans('general.?') }}</span><?php
        ?> <a class="helpContact-button" href="{{ url('/contact') }}">{!! trans('contact.leaveMessage') !!}</a><?php
        ?> <span class="helpContact-smallText">{{ trans('contact.or') }}</span><?php
        ?> <a class="helpContact-button" href="{{ url('/faq') }}">{!! trans('contact.readFAQ') !!}</a>
    </div>
</div>
@endsection