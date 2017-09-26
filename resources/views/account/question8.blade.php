@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 8))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-8') }}<span class="question-title-optional"> - {{ trans('questions.optionalQuestion') }}</span></h2>
        
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
            
            <h3 class="question-fieldTitle">{{ trans('questions.showBodyPartsTitle') . trans('general.?') }}</h3>
            
            <table class="question-showBodyParts" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <th></th>
                    <th>{{ trans('questions.hide') }}</th>
                    <th>{{ trans('questions.show') }}</th>
                </tr>
                @foreach (array('arms', 'legs', 'chest', 'belly', 'waist', 'buttocks', 'neck', 'knees') as $bodyPart)
                <tr>
                    <td>{{ trans('questions.' . $bodyPart) }}</td>
                    <td>
                        <input class="question-checkbox" type="checkbox" name="preferences[show{{ ucfirst($bodyPart) }}][]" value="0" id="hide_{{ $bodyPart }}"
                            {{ array_key_exists('show' . ucfirst($bodyPart), $preferences) && in_array(0, $preferences['show' . ucfirst($bodyPart)]) ? ' checked="checked"' : '' }}
                        >
                        <button type="button" data-real-input="#hide_{{ $bodyPart }}"
                            class="question-showBodyPart js-fakeInput{{ array_key_exists('show' . ucfirst($bodyPart), $preferences) && in_array(0, $preferences['show' . ucfirst($bodyPart)]) ? ' fakeInput-checked' : '' }}"
                        ></button>
                    </td>
                    <td>
                        <input class="question-checkbox" type="checkbox" name="preferences[show{{ ucfirst($bodyPart) }}][]" value="1" id="show_{{ $bodyPart }}"
                            {{ array_key_exists('show' . ucfirst($bodyPart), $preferences) && in_array(1, $preferences['show' . ucfirst($bodyPart)]) ? ' checked="checked"' : '' }}
                        >
                        <button type="button" data-real-input="#show_{{ $bodyPart }}"
                            class="question-showBodyPart js-fakeInput{{ array_key_exists('show' . ucfirst($bodyPart), $preferences) && in_array(1, $preferences['show' . ucfirst($bodyPart)]) ? ' fakeInput-checked' : '' }}"
                        ></button>
                    </td>
                </tr>
                @endforeach
            </table>
            
            <h3 class="question-fieldTitle">{{ trans('questions.favoriteClothesTitle') . trans('general.:') }}</h3>
            
            @foreach ($fields['favoriteClothes'] as $favoriteClothes)<?php
                ?><div class="question-favoriteClothesField">
                    <input class="question-checkbox" type="checkbox" name="preferences[favoriteClothes][]" value="{{ $favoriteClothes }}" id="favoriteClothes_{{ $favoriteClothes }}"
                        {{ array_key_exists('favoriteClothes', $preferences) && in_array($favoriteClothes, $preferences['favoriteClothes']) ? ' checked="checked"' : '' }}
                    >
                    <button type="button" data-real-input="#favoriteClothes_{{ $favoriteClothes }}"
                        class="question-favoriteClothes js-fakeInput{{ array_key_exists('favoriteClothes', $preferences) && in_array($favoriteClothes, $preferences['favoriteClothes']) ? ' fakeInput-checked' : '' }}"
                    ></button><?php
                    ?><label class="question-favoriteClothesLabel" for="favoriteClothes_{{ $favoriteClothes }}">{{ trans('questions.' . $favoriteClothes) }}</label>
                </div><?php
            ?>@endforeach
            
            <a href="{{ url('account/question/7') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.skip') !!}</button>
        </form>
    </div>
</div>

@endsection