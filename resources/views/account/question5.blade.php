@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 5))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-5') }}</h2>
        
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
            
            <div class="question-measurementsGroup-left">
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.heightTitle') . trans('general.:') }}</h3>
                    <select class="question-heightSelect js-select2" name="preferences[height]" id="height">
                        <option value=""></option>
                        @for ($i = 58; $i <= 78; $i++)
                            <option value="{{ $i }}"{{ array_key_exists('height', $preferences) && $preferences['height'] == $i ? ' selected="selected"' : '' }}>
                                {{ floor($i/12) . ' ' . trans('questions.feet') . ($i % 12 != 0 ? (' ' . $i % 12 . ' ' . trans_choice('questions.inch', $i % 12)) : '') }}
                            </option>
                        @endfor
                    </select>
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.weightUnit') . trans('general.:') }}</h3>
                    <input class="question-weightInput" type="text" name="preferences[weight]" id="weight"
                        {!! array_key_exists('weight', $preferences) && $preferences['weight'] != '' ? ' value="'.$preferences['weight'].'"' : '' !!}
                    ><?php
                    ?>@foreach ($fields['weightUnits'] as $weightUnit)<?php
                        ?><div class="question-measurementsRadioGroup">
                            <input class="question-radio" type="radio" name="preferences[weightUnit][]" value="{{ $weightUnit }}" id="weightUnit_{{ $weightUnit }}"
                                {{ array_key_exists('weightUnit', $preferences) && in_array($weightUnit, $preferences['weightUnit']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#weightUnit_{{ $weightUnit }}"
                                class="question-measurementsRadio js-fakeInput{{ array_key_exists('weightUnit', $preferences) && in_array($weightUnit, $preferences['weightUnit']) ? ' fakeInput-checked' : '' }}"
                            ></button><?php
                            ?><label class="question-measurementsLabel" for="weightUnit_{{ $weightUnit }}">{{ trans('questions.' . $weightUnit) }}</label>
                        </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.braSizeTitle') . trans('general.:') }}</h3>
                    <select class="question-braBandSizeSelect js-select2" name="preferences[braBandSize]" id="braBandSize">
                        <option value=""></option>
                        <option value="n/a">N/A</option>
                        @for ($i = 32; $i <= 38; $i+=2)
                            <option value="{{ $i }}"{{ array_key_exists('braBandSize', $preferences) && $preferences['braBandSize'] == $i ? ' selected="selected"' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <select class="question-measurementsSelect js-select2" name="preferences[braCupSize]" id="braCupSize">
                        <option value=""></option>
                        <option value="n/a">N/A</option>
                        @foreach (array('a', 'b', 'c', 'd', 'dd', 'ddd', 'e', 'ee', 'eee', 'f') as $letter)
                            <option value="{{ $letter }}"
                                {{ array_key_exists('braCupSize', $preferences) && $preferences['braCupSize'] == $letter ? ' selected="selected"' : '' }}
                            >{{ strtoupper($letter) }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.shoeSizeTitle') . trans('general.:') }}</h3>
                    <select class="question-measurementsSelect js-select2" name="preferences[shoeSize]" id="shoeSize">
                        <option value=""></option>
                        @for ($i = 6; $i <= 12; $i += 0.5)
                            <option value="{{ $i }}"{{ array_key_exists('shoeSize', $preferences) && $preferences['shoeSize'] == $i ? ' selected="selected"' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.allergiesTitle') . trans('general.?') }}</h3>
                    <input class="question-measurementsInput" type="text" name="preferences[allergies]" id="allergies"
                        {!! array_key_exists('allergies', $preferences) && $preferences['allergies'] != '' ? ' value="'.$preferences['allergies'].'"' : '' !!}
                    >
                </div>
            </div><?php
            
            ?><div class="question-measurementsGroup-right">
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.pantsSizeTitle') . trans('general.:') }}</h3>
                    <select class="question-measurementsSelect js-select2" name="preferences[pantsSize]" id="pantsSize">
                        <option value=""></option>
                        @for ($i = 2; $i <= 20; $i += 2)
                            <option value="{{ $i }}"{{ array_key_exists('pantsSize', $preferences) && $preferences['pantsSize'] == $i ? ' selected="selected"' : '' }}>{{ $i }}</option>
                        @endfor
                    </select><?php
                    ?><button type="button" class="question-europeanChartButton" data-toggle="modal" data-target="#modal-chart">{{ trans('questions.chart') }}</button>
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.favoritePantsTitle') . trans('general.:') }}</h3>
                    @foreach ($fields['favoritePants'] as $favoritePants)<?php
                        ?><div class="question-measurementsRadioGroup">
                            <input class="question-radio" type="radio" name="preferences[favoritePants][]" value="{{ $favoritePants }}" id="favoritePants_{{ $favoritePants }}"
                                {{ array_key_exists('favoritePants', $preferences) && in_array($favoritePants, $preferences['favoritePants']) ? ' checked="checked"' : '' }}
                            >
                            <button type="button" data-real-input="#favoritePants_{{ $favoritePants }}"
                                class="question-measurementsRadio js-fakeInput{{ array_key_exists('favoritePants', $preferences) && in_array($favoritePants, $preferences['favoritePants']) ? ' fakeInput-checked' : '' }}"
                            ></button><?php
                            ?><label class="question-measurementsLabel" for="favoritePants_{{ $favoritePants }}">{{ trans('questions.' . $favoritePants) }}</label>
                        </div><?php
                    ?>@endforeach
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.shirtSizeTitle') . trans('general.:') }}</h3>
                    <select class="question-measurementsSelect js-select2" name="preferences[shirtSize]" id="shirtSize">
                        <option value=""></option>
                        @for ($i = 2; $i <= 20; $i += 2)
                            <option value="{{ $i }}"{{ array_key_exists('shirtSize', $preferences) && $preferences['shirtSize'] == $i ? ' selected="selected"' : '' }}>{{ $i }}</option>
                        @endfor
                    </select><?php
                    ?><button type="button" class="question-europeanChartButton" data-toggle="modal" data-target="#modal-chart">{{ trans('questions.chart') }}</button>
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.dressSizeTitle') . trans('general.:') }}</h3>
                    <select class="question-measurementsSelect js-select2" name="preferences[dressSize]" id="dressSize">
                        <option value=""></option>
                        @for ($i = 2; $i <= 20; $i += 2)
                            <option value="{{ $i }}"{{ array_key_exists('dressSize', $preferences) && $preferences['dressSize'] == $i ? ' selected="selected"' : '' }}>{{ $i }}</option>
                        @endfor
                    </select><?php
                    ?><button type="button" class="question-europeanChartButton" data-toggle="modal" data-target="#modal-chart">{{ trans('questions.chart') }}</button>
                </div>
                
                <div class="question-field">
                    <h3 class="question-measurementsTitle">{{ trans('questions.piercedEarsTitle') . trans('general.?') }}</h3>
                    <div class="question-measurementsRadioGroup">
                        <input class="question-radio" type="radio" name="preferences[piercedEars][]" value="1" id="piercedEars_yes"
                            {{ array_key_exists('piercedEars', $preferences) && in_array(1, $preferences['piercedEars']) ? ' checked="checked"' : '' }}
                        >
                        <button type="button" data-real-input="#piercedEars_yes"
                            class="question-measurementsRadio js-fakeInput{{ array_key_exists('piercedEars', $preferences) && in_array(1, $preferences['piercedEars']) ? ' fakeInput-checked' : '' }}"
                        ></button><?php
                        ?><label class="question-measurementsLabel" for="piercedEars_yes">{{ trans('questions.yes') }}</label>
                    </div><?php
                    ?><div class="question-measurementsRadioGroup">
                        <input class="question-radio" type="radio" name="preferences[piercedEars][]" value="0" id="piercedEars_no"
                            {{ array_key_exists('piercedEars', $preferences) && in_array(0, $preferences['piercedEars']) ? ' checked="checked"' : '' }}
                        >
                        <button type="button" data-real-input="#piercedEars_no"
                            class="question-measurementsRadio js-fakeInput{{ array_key_exists('piercedEars', $preferences) && in_array(0, $preferences['piercedEars']) ? ' fakeInput-checked' : '' }}"
                        ></button><?php
                        ?><label class="question-measurementsLabel" for="piercedEars_no">{{ trans('questions.no') }}</label>
                    </div>
                </div>
            </div>
            
            <a href="{{ url('account/question/4') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.nextStep') !!}</button>
        </form>
    </div>
</div>

@endsection