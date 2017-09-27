@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question-contactInformation">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 10))
    </div>
    
    <div class="layout-imageFormImage">
        <img style="width: 100%;" src="/images/profileCompleted-summer.jpg" alt="">
    </div><?php
    
    ?><div class="layout-imageFormForm">
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
            
            <h2 class="question-contactInformationTitle">{{ trans('questions.contactInformationTitle') . trans('general.!') }}</h2>
            <h3 class="question-contactInformationSubtitle">{{ trans('questions.title-10') }}</h3>

            <div class="form-field">
                <input class="form-input" type="text" name="preferences[name]" placeholder="{{ trans('questions.name') }}"
                        {!! Auth::user()->name ? ' value="'.Auth::user()->name.'"' : (array_key_exists('name', $preferences) && $preferences['name'] != '' ? ' value="'.$preferences['name'].'"' : '') !!}
                >
            </div>
            <div class="form-field">
                <input class="form-input" type="text" name="preferences[address]" placeholder="{{ trans('questions.address') }}"
                    {!! array_key_exists('address', $preferences) && $preferences['address'] != '' ? ' value="'.$preferences['address'].'"' : '' !!}
                >
            </div>
            <div class="form-field">
                <input class="form-input" type="text" name="preferences[city]" placeholder="{{ trans('questions.city') }}"
                    {!! array_key_exists('city', $preferences) && $preferences['city'] != '' ? ' value="'.$preferences['city'].'"' : '' !!}
                >
            </div>
            <div class="question-contactInformationTwoFields">
                <div class="form-field">
                    <input class="form-input" type="text" name="preferences[postal_code]" placeholder="{{ trans('questions.postalCode') }}"
                        {!! array_key_exists('postal_code', $preferences) && $preferences['postal_code'] != '' ? ' value="'.$preferences['postal_code'].'"' : '' !!}
                    >
                </div><?php
                ?><div class="form-field">
                    <select class="question-contactInformationProvince js-select2" name="preferences[province]">
                        @foreach ($fields['provinces'] as $key => $province)
                        <option{{
                            (array_key_exists('province', $preferences) && $preferences['province'] == $key) ||
                            (!array_key_exists('province', $preferences) && $key == 'quebec') ?
                            ' selected="selected"' : ''
                        }} value="{{ $key }}">{{ $province }}</option>
                        @endforeach
                    </select>
                    <?php /*<input class="form-input" type="text" name="preferences[province]" placeholder="{{ trans('questions.province') }}"
                        {!! array_key_exists('province', $preferences) && $preferences['province'] != '' ? ' value="'.$preferences['province'].'"' : '' !!}
                    >*/ ?>
                </div>
            </div>
            <div class="question-contactInformationTwoFields">
                <div class="form-field">
                    <div class="question-contactInformationFakeInput">Canada</div>
                </div><?php
                ?><div class="form-field">
                    <input class="form-input" type="phone" name="preferences[phone]" placeholder="{{ trans('questions.phone') }}"
                        {!! array_key_exists('phone', $preferences) && $preferences['phone'] != '' ? ' value="'.$preferences['phone'].'"' : '' !!}
                    >
                </div>
            </div>
            
            <p class="question-contactInformationContactMethodTitle">{{ trans('questions.preferred_contact_method') }}</p>
            <div class="question-contactInformationTwoSeparatedFields">
                <div class="form-field">
                    <select class="question-contactInformationContactMethod js-contactMethod js-select2" name="preferences[contact_method]" data-select2hidesearch="true">
                        <option value=""></option>
                        <option{{ array_key_exists('contact_method', $preferences) && $preferences['contact_method'] == 'phone' ? ' selected="selected"' : '' }} value="phone">{{ trans('questions.phone') }}</option>
                        <option{{ (array_key_exists('contact_method', $preferences) && $preferences['contact_method'] == 'email') || !array_key_exists('contact_method', $preferences) ? ' selected="selected"' : '' }} value="email">{{ trans('questions.email') }}</option>
                    </select>
                </div><?php
                ?><div class="form-field">
                    <select class="question-contactInformationContactHours{{ array_key_exists('contact_method', $preferences) && $preferences['contact_method'] == 'phone' ? ' question-contactInformationContactHours-visible' : '' }} js-contactHours js-select2" name="preferences[contact_hours]">
                        <option value=""></option>
                        <option{{ array_key_exists('contact_hours', $preferences) && $preferences['contact_hours'] == '6_12' ? ' selected="selected"' : '' }} value="6_12">{{ trans('questions.6_12') }}</option>
                        <option{{ array_key_exists('contact_hours', $preferences) && $preferences['contact_hours'] == '12_18' ? ' selected="selected"' : '' }} value="12_18">{{ trans('questions.12_18') }}</option>
                        <option{{ array_key_exists('contact_hours', $preferences) && $preferences['contact_hours'] == '18_24' ? ' selected="selected"' : '' }} value="18_24">{{ trans('questions.18_24') }}</option>
                    </select>
                </div>
            </div>

            <div class="form-field">
                <label class="question-contactInformationContactMethodTitle" for="birthdayYearField">Date de naissance</label>
                <div class="row">
                    <div class="col-xs-3" style="padding-right: 0;">
                        <input class="form-input" id="birthdayYearField" type="text" name="preferences[birthday][year]" placeholder="{{ trans('questions.birthdayYearPlaceholder') }}" style="border-right: 0;"
                                {!! !empty($preferences['birthday']['year']) ? ' value="' . $preferences['birthday']['year'] . '"' : '' !!}
                        >
                    </div>
                    <div class="col-xs-2" style="padding: 0;">
                        <input class="form-input" type="text" name="preferences[birthday][month]" placeholder="{{ trans('questions.birthdayMonthPlaceholder') }}" style="border-right: 0;"
                                {!! !empty($preferences['birthday']['month']) ? ' value="' . $preferences['birthday']['month'] . '"' : '' !!}
                        >
                    </div>
                    <div class="col-xs-2" style="padding-left: 0;">
                        <input class="form-input" type="text" name="preferences[birthday][day]" placeholder="{{ trans('questions.birthdayDayPlaceholder') }}"
                                {!! !empty($preferences['birthday']['day']) ? ' value="' . $preferences['birthday']['day'] . '"' : '' !!}
                        >
                    </div>
                </div>
            </div>

            <div class="form-field">
                <input class="form-checkbox" type="checkbox" id="terms" name="preferences[terms]"
                    {{ array_key_exists('terms', $preferences) ? ' checked="checked"' : '' }}
                ><?php
                ?><label class="form-label" for="terms">{{ trans('auth.accept') }} <a href="javascript:;" data-toggle="modal" data-target="#modal-terms">{{ trans('auth.terms') }}</a></label>
            </div>
            <div class="form-field">
                <button type="submit" class="question-contactInformationSubmitButton">{{ trans('questions.finalSave') }}</button>
            </div>
        </form>
    </div>
    
</div>

@endsection