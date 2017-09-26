@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 6))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-6') }}<span class="question-title-optional"> - {{ trans('questions.optionalQuestion') }}</span></h2>
        
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
            
            <div class="question-exclusionsGroup-left">
                <h3 class="question-exclusionsTitle">{{ trans('questions.excludedClothesTitle') }} <strong style="font-weight: 600;">{{ trans('questions.excludedClothesTitleBold') }}</strong>{{ trans('general.:') }}</h3>
                
                <div class="question-field">
                    <h3 class="question-exclusionsFieldTitle">{{ trans('questions.dresses') . trans('general.:') }}</h3>
                    @foreach ($fields['excludedSkirts'] as $excludedSkirts)<?php
                        ?><div class="question-exclusionsCheckboxGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[excludedSkirts][]" value="{{ $excludedSkirts }}" id="excludedSkirts_{{ $excludedSkirts }}"
                                {{ array_key_exists('excludedSkirts', $preferences) && in_array($excludedSkirts, $preferences['excludedSkirts']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#excludedSkirts_{{ $excludedSkirts }}"
                                class="question-excludedInput js-fakeInput{{ array_key_exists('excludedSkirts', $preferences) && in_array($excludedSkirts, $preferences['excludedSkirts']) ? ' fakeInput-checked' : '' }}"
                            ></button><?php
                            ?><label class="question-excludedLabel" for="excludedSkirts_{{ $excludedSkirts }}">{{ trans('questions.' . $excludedSkirts) }}</label>
                        </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-field">
                    <h3 class="question-exclusionsFieldTitle">{{ trans('questions.pants') . trans('general.:') }}</h3>
                    @foreach ($fields['excludedPants'] as $excludedPants)<?php
                        ?><div class="question-exclusionsCheckboxGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[excludedPants][]" value="{{ $excludedPants }}" id="excludedPants_{{ $excludedPants }}"
                                {{ array_key_exists('excludedPants', $preferences) && in_array($excludedPants, $preferences['excludedPants']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#excludedPants_{{ $excludedPants }}"
                                class="question-excludedInput js-fakeInput{{ array_key_exists('excludedPants', $preferences) && in_array($excludedPants, $preferences['excludedPants']) ? ' fakeInput-checked' : '' }}"
                            ></button><?php
                            ?><label class="question-excludedLabel" for="excludedPants_{{ $excludedPants }}">{{ trans('questions.' . $excludedPants) }}</label>
                        </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-field">
                    <h3 class="question-exclusionsFieldTitle">{{ trans('questions.tops') . trans('general.:') }}</h3>
                    @foreach ($fields['excludedTops'] as $excludedTops)<?php
                        ?><div class="question-exclusionsCheckboxGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[excludedTops][]" value="{{ $excludedTops }}" id="excludedTops_{{ $excludedTops }}"
                                {{ array_key_exists('excludedTops', $preferences) && in_array($excludedTops, $preferences['excludedTops']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#excludedTops_{{ $excludedTops }}"
                                class="question-excludedInput js-fakeInput{{ array_key_exists('excludedTops', $preferences) && in_array($excludedTops, $preferences['excludedTops']) ? ' fakeInput-checked' : '' }}"
                            ></button><?php
                            ?><label class="question-excludedLabel" for="excludedTops_{{ $excludedTops }}">{{ trans('questions.' . $excludedTops) }}</label>
                        </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-field">
                    <h3 class="question-exclusionsFieldTitle">{{ trans('questions.necks') . trans('general.:') }}</h3>
                    @foreach ($fields['excludedNecks'] as $excludedNecks)<?php
                        ?><div class="question-exclusionsCheckboxGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[excludedNecks][]" value="{{ $excludedNecks }}" id="excludedNecks_{{ $excludedNecks }}"
                                {{ array_key_exists('excludedNecks', $preferences) && in_array($excludedNecks, $preferences['excludedNecks']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#excludedNecks_{{ $excludedNecks }}"
                                class="question-excludedInput js-fakeInput{{ array_key_exists('excludedNecks', $preferences) && in_array($excludedNecks, $preferences['excludedNecks']) ? ' fakeInput-checked' : '' }}"
                            ></button><?php
                            ?><label class="question-excludedLabel" for="excludedNecks_{{ $excludedNecks }}">{{ trans('questions.' . $excludedNecks) }}</label>
                        </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-field">
                    <h3 class="question-exclusionsFieldTitle">{{ trans('questions.clothes') . trans('general.:') }}</h3>
                    @foreach ($fields['excludedClothes'] as $excludedClothes)<?php
                        ?><div class="question-exclusionsCheckboxGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[excludedClothes][]" value="{{ $excludedClothes }}" id="excludedClothes_{{ $excludedClothes }}"
                                {{ array_key_exists('excludedClothes', $preferences) && in_array($excludedClothes, $preferences['excludedClothes']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#excludedClothes_{{ $excludedClothes }}"
                                class="question-excludedInput js-fakeInput{{ array_key_exists('excludedClothes', $preferences) && in_array($excludedClothes, $preferences['excludedClothes']) ? ' fakeInput-checked' : '' }}"
                            ></button><?php
                            ?><label class="question-excludedLabel" for="excludedClothes_{{ $excludedClothes }}">{{ trans('questions.' . $excludedClothes) }}</label>
                        </div><?php
                    ?>@endforeach
                </div>
            </div><?php
            
            ?><div class="question-exclusionsGroup-right">
                <div class="question-field">
                    <h3 class="question-exclusionsTitle">{{ trans('questions.excludedColorsTitle') . trans('general.:') }}</h3>
                    @foreach ($fields['excludedColors'] as $excludedColors)<?php
                        ?><div class="question-exclusionsColorsGroup">
                            <input class="question-checkbox" type="checkbox" name="preferences[excludedColors][]" value="{{ $excludedColors }}" id="excludedColors_{{ $excludedColors }}"
                                {{ array_key_exists('excludedColors', $preferences) && in_array($excludedColors, $preferences['excludedColors']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#excludedColors_{{ $excludedColors }}"
                                class="question-excludedColorsInput js-fakeInput{{ array_key_exists('excludedColors', $preferences) && in_array($excludedColors, $preferences['excludedColors']) ? ' fakeInput-checked' : '' }}"
                            >
                                <div class="question-excludedColorsImage" style="background-color: #{{ $excludedColors == 'ffffff' ? 'f8f8f8' : $excludedColors }};"></div>
                            </button>
                        </div><?php
                    ?>@endforeach
                </div>
            </div>
            
            <a href="{{ url('account/question/5') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.skip') !!}</button>
        </form>
    </div>
</div>

@endsection