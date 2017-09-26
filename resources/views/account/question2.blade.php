@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 2))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-2') }}</h2>
        
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
            
            <div class="layout-row">
                <div class="question-hairColorGroup">
                    <h3 class="question-colorsTitle">{{ trans('questions.hairColorTitle') . trans('general.:') }}</h3>
                    
                    @foreach ($fields['hairColors'] as $hairColor)<?php
                    ?><div class="question-colorsField">
                        <input class="question-radio" type="radio" name="preferences[hairColor][]" value="{{ $hairColor }}" id="hairColor_{{ $hairColor }}"
                            {{ array_key_exists('hairColor', $preferences) && in_array($hairColor, $preferences['hairColor']) ? ' checked="checked"' : '' }}
                        >
                        <button type="button" data-real-input="#hairColor_{{ $hairColor }}"
                            class="question-colorsInput js-fakeInput{{ array_key_exists('hairColor', $preferences) && in_array($hairColor, $preferences['hairColor']) ? ' fakeInput-checked' : '' }}"
                        >
                            <img class="question-colorImage" src="/images/cheveux-{{ $hairColor }}.jpg" alt="">
                        </button>
                    </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-eyeColorGroup">
                    <h3 class="question-colorsTitle">{{ trans('questions.eyesColorTitle') . trans('general.:') }}</h3>
                    
                    @foreach ($fields['eyeColors'] as $eyeColor)<?php
                    ?><div class="question-colorsField">
                        <input class="question-radio" type="radio" name="preferences[eyeColor][]" value="{{ $eyeColor }}" id="eyeColor_{{ $eyeColor }}"
                            {{ array_key_exists('eyeColor', $preferences) && in_array($eyeColor, $preferences['eyeColor']) ? ' checked="checked"' : '' }}
                        >
                        <button type="button" data-real-input="#eyeColor_{{ $eyeColor }}"
                            class="question-colorsInput js-fakeInput{{ array_key_exists('eyeColor', $preferences) && in_array($eyeColor, $preferences['eyeColor']) ? ' fakeInput-checked' : '' }}"
                        >
                            <img class="question-colorImage" src="/images/yeux-{{ $eyeColor }}.jpg" alt="">
                        </button>
                    </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-skinColorGroup">
                    <h3 class="question-colorsTitle">{{ trans('questions.skinColorTitle') . trans('general.:') }}</h3>
                    
                    @foreach ($fields['skinColors'] as $skinColor)<?php
                    ?><div class="question-colorsField">
                        <input class="question-radio" type="radio" name="preferences[skinColor][]" value="{{ $skinColor }}" id="skinColor_{{ $skinColor }}"
                            {{ array_key_exists('skinColor', $preferences) && in_array($skinColor, $preferences['skinColor']) ? ' checked="checked"' : '' }}
                        >
                        <button type="button" data-real-input="#skinColor_{{ $skinColor }}"
                            class="question-colorsInput js-fakeInput{{ array_key_exists('skinColor', $preferences) && in_array($skinColor, $preferences['skinColor']) ? ' fakeInput-checked' : '' }}"
                        >
                            <div class="question-skinColorImage" style="background-color: #{{ $skinColor }};"></div>
                        </button>
                    </div><?php
                    ?>@endforeach
                </div>
            </div>
            
            <a href="{{ url('account/question/1') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.nextStep') !!}</button>
        </form>
    </div>
</div>

@endsection