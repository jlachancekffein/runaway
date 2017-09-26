@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 1))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-1') }}<span class="question-title-optional"> - {{ trans('questions.optionalQuestion') }}</span></h2>
        
        <form class="js-ajaxForm" action="{{ URL::current() }}" method="post" onsubmit="return false;">
            {{ csrf_field() }}
            
            <h3 class="question-fieldTitle">{{ trans('questions.stylesTitle') . trans('general.:') }}</h3>
            
            <div class="form-errors">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="form-error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            
            <div class="question-stylesGroup">
                @foreach ($fields['styles'] as $style)<?php
                ?><div class="question-stylesField">
                    <input class="question-stylesInput" type="checkbox" name="preferences[styles][]" value="{{ $style }}" id="styles_{{ $style }}"
                        {{ array_key_exists('styles', $preferences) && in_array($style, $preferences['styles']) ? ' checked="checked"' : '' }}
                    >
                    <label class="question-stylesLabel" for="styles_{{ $style }}">
                        <img class="question-stylesImage" src="/images/style-{{ $style }}.jpg" alt="">
                        {{ trans('questions.style-' . $style) }}
                    </label>
                </div><?php
                ?>@endforeach
            </div>
            
            <button class="question-submit" type="submit">{!! trans('questions.skip') !!}</button>
        </form>
    </div>
</div>

@endsection