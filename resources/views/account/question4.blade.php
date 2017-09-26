@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
        
        @include('partials.question-progression', array('current' => 4))
    </div>
    
    <div class="question-container">
        <h2 class="question-title">{{ trans('questions.title-4') }}<span class="question-title-optional"> - {{ trans('questions.optionalQuestion') }}</span></h2>
        
        <form class=""
              action="{{ URL::current() . (app('request')->input('modify') ? '' : '') }}" method="post" enctype="multipart/form-data"
        >
            {{ csrf_field() }}
            
            <div class="form-errors">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="form-error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            
            <div class="question-photoContainer">
                <div class="question-photoGroup-texts">
                    <p class="question-photoDescription">{{ trans('questions.photoDescription') }}</p>
                    <p class="question-photoHowToTitle">{{ trans('questions.photoHowToTitle') . trans('general.:') }}</p>
                    <ul class="question-photoHowToList">
                        @for ($i = 1; $i <= 5; $i++)
                            <li>{{ trans('questions.photoHowToList-' . $i) }}</li>
                        @endfor
                    </ul>
                </div><?php
                
                ?><div class="question-photoGroup-inputs">
                    <h3 class="question-photoTitle">{{ trans('questions.photoTitle') . trans('general.:') }}</h3>
                    <div class="question-photoField">
                        <label class="question-photoLabel" for="photo">{{ trans('questions.photoLabel') }}</label>
                        <input class="question-photoInput js-fileUpload" type="file" name="preferences[photo]" id="photo" data-photo="#question-photoContainer">
                    </div>
                    <img id="question-photoContainer" class="question-photoImage" alt=""
                        src="{{ array_key_exists('photo', $preferences) && $preferences['photo'] == 1 ? url('account/images/photo.jpg') : '/images/question-photo-placeholder-'.App::getLocale().'.jpg' }}"
                    >
                </div>
            </div>
            
            <a href="{{ url('account/question/3') }}" class="question-previous">{{ trans('questions.previousStep') }}</a>
            <button class="question-submit" type="submit">{!! trans('questions.skip') !!}</button>
        </form>
    </div>
</div>

@endsection