@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 9))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-9') }}<span class="question-title-optional"> - {{ trans('questions.optionalQuestion') }}</span></h2>
        
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
            
            <div class="question-brandGroup">
                <h3 class="question-brandTitle">{{ trans('questions.favoriteBrandsTitle') . trans('general.:') }}</h3><?php
                
                ?>@foreach ($fields['brands'] as $brand=>$data)<?php
                ?><div class="question-brandField">
                    <input class="question-checkbox" type="checkbox" name="preferences[brand][]" value="{{ $brand }}" id="brand_{{ $brand }}"
                        {{ array_key_exists('brand', $preferences) && in_array($brand, $preferences['brand']) ? ' checked="checked"' : '' }}
                    >
                    <button type="button" data-real-input="#brand_{{ $brand }}"
                        class="question-brandInput js-fakeInput{{ array_key_exists('brand', $preferences) && in_array($brand, $preferences['brand']) ? ' fakeInput-checked' : '' }}"
                    >
                        <div class="question-brandImageContainer">
                            <img class="question-brandImage" src="/images/marque-{{ $brand }}.png" alt="">
                        </div>
                        <img class="question-brandMannequinImage" src="/images/marqueMannequin-{{ $brand }}.jpg" alt="">
                    </button>
                    <label class="question-brandLabel" for="brand_{{ $brand }}">
                      {{ trans('questions.' . $brand) }}<br />
                      <small>{{ trans('questions.size') }} {{ $data['size']['min'] }} {{ trans('questions.of') }} {{ $data['size']['max'] }}</small>
                    </label>
                </div><?php
                ?>@endforeach
            </div>
            
            <a href="{{ url('account/question/8') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.skip') !!}</button>
        </form>
    </div>
</div>

@endsection