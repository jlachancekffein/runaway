@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 3))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-3') }}</h2>
        
        <form class="js-ajaxForm<?php /* question-autoSubmitForm js-autoSubmitForm*/ ?>"
              action="{{ URL::current() }}" method="post" onsubmit="return false;"
        >
            {{ csrf_field() }}
            
            <div class="form-errors">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="form-error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            
            <div class="question-bodyShapeGroup">
                <h3 class="question-bodyShapeTitle">{{ trans('questions.bodyShapeTitle') . trans('general.:') }}</h3><?php
                
                ?>@foreach ($fields['bodyShapes'] as $bodyShape)<?php
                ?><div class="question-bodyShapeField">
                    <input class="question-radio" type="radio" name="preferences[bodyShape][]" value="{{ $bodyShape }}" id="bodyShape_{{ $bodyShape }}"
                        {{ array_key_exists('bodyShape', $preferences) && in_array($bodyShape, $preferences['bodyShape']) ? ' checked="checked"' : '' }}
                    >
                    <button type="button" data-real-input="#bodyShape_{{ $bodyShape }}"
                        class="question-bodyShapeInput js-fakeInput{{ array_key_exists('bodyShape', $preferences) && in_array($bodyShape, $preferences['bodyShape']) ? ' fakeInput-checked' : '' }}"
                    >
                        <img class="question-bodyShapeImage" src="/images/corps-{{ $bodyShape }}.jpg" alt="">
                        <div style="margin-top: 3px; text-align: center;">{{ trans('questions.bodyShape-'.$bodyShape) }}</div>
                    </button>
                </div><?php
                ?>@endforeach
            </div>
            
            <a href="{{ url('account/question/2') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.nextStep') !!}</button>
        </form>
    </div>
</div>

@endsection