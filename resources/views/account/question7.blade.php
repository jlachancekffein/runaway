@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 7))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-7') }}<span class="question-title-optional"> - {{ trans('questions.optionalQuestion') }}</span></h2>
        
        <form class="js-ajaxForm"
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
            
            <div class="question-favoriteGroup-left">
                <div class="question-field">
                    <h3 class="question-favoriteFieldTitle">{{ trans('questions.favoritePatternsTitle') . trans('general.:') }}</h3>
                    @foreach ($fields['favoritePatterns'] as $favoritePatterns)<?php
                        ?><div class="question-favoritePatternsGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[favoritePatterns][]" value="{{ $favoritePatterns }}" id="favoritePatterns_{{ $favoritePatterns }}"
                                {{ array_key_exists('favoritePatterns', $preferences) && in_array($favoritePatterns, $preferences['favoritePatterns']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#favoritePatterns_{{ $favoritePatterns }}"
                                class="question-favoritePatternsInput js-fakeInput{{ array_key_exists('favoritePatterns', $preferences) && in_array($favoritePatterns, $preferences['favoritePatterns']) ? ' fakeInput-checked' : '' }}"
                            >
                                <img class="question-favoriteImage" src="/images/pattern-{{ $favoritePatterns }}.jpg" alt="">
                                <span>{{ trans('questions.favoritePatterns-' . $favoritePatterns) }}</span>
                            </button>
                        </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-field">
                    <h3 class="question-favoriteFieldTitle">{{ trans('questions.favoriteAccessoriesTitle') . trans('general.:') }}</h3>
                    @foreach ($fields['favoriteAccessories'] as $favoriteAccessories)<?php
                        ?><div class="question-favoriteAccessoriesGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[favoriteAccessories][]" value="{{ $favoriteAccessories }}" id="favoriteAccessories_{{ $favoriteAccessories }}"
                                {{ array_key_exists('favoriteAccessories', $preferences) && in_array($favoriteAccessories, $preferences['favoriteAccessories']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#favoriteAccessories_{{ $favoriteAccessories }}"
                                class="question-favoriteAccessoriesInput js-fakeInput{{ array_key_exists('favoriteAccessories', $preferences) && in_array($favoriteAccessories, $preferences['favoriteAccessories']) ? ' fakeInput-checked' : '' }}"
                            >
                                <img class="question-favoriteImage" src="/images/accessory-{{ $favoriteAccessories }}.jpg" alt="">
                                <span>{{ trans('questions.favoriteAccessories-' . $favoriteAccessories) }}</span>
                            </button>
                        </div><?php
                    ?>@endforeach
                </div>
            </div><?php
            
            ?><div class="question-favoriteGroup-right">
                <div class="question-field">
                    <h3 class="question-favoriteFieldTitle">{{ trans('questions.favoriteColorsTitle') . trans('general.:') }}</h3>
                    @foreach ($fields['favoriteColors'] as $favoriteColors)<?php
                        ?><div class="question-favoriteColorsGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[favoriteColors][]" value="{{ $favoriteColors }}" id="favoriteColors_{{ $favoriteColors }}"
                                {{ array_key_exists('favoriteColors', $preferences) && in_array($favoriteColors, $preferences['favoriteColors']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#favoriteColors_{{ $favoriteColors }}"
                                class="question-favoriteColorsInput js-fakeInput{{ array_key_exists('favoriteColors', $preferences) && in_array($favoriteColors, $preferences['favoriteColors']) ? ' fakeInput-checked' : '' }}"
                            >
                                <div class="question-favoriteColorsImage" style="background-color: #{{ $favoriteColors == 'ffffff' ? 'f8f8f8' : $favoriteColors }};"></div>
                            </button>
                        </div><?php
                    ?>@endforeach
                </div>
            </div>
            
            <a href="{{ url('account/question/6') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.skip') !!}</button>
        </form>
    </div>
</div>

@endsection