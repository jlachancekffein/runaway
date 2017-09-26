@extends('layouts.questions')

@section('content')

<div class="layout-noPaddingContainer">
    <div class="question-contactInformation">
        <h1 class="mainTitle">{{ trans('questions.headerTitle') }}</h1>
    </div>
    
    <div class="question-finalStepImageMessageImage">
        <img style="width: 100%;" src="/images/getstarted.jpg" alt="">
    </div><?php
    
    ?><div class="question-finalStepImageMessageMessage">
        <h2 class="question-finalStepTitle">{{ trans('questions.finalStepTitle', ['name' => $username]) }}</h2>
        <div class="question-finalStepText">
            {!! trans('questions.finalStepText', ['email' => $email]) !!}
            <?php /*<img class="question-finalStepSignature" src="/images/mc-cheikha.jpg" alt="">
            <p>{{ trans('questions.finalStepFounder') }}</p>*/ ?>
            <a class="button question-final-btn" href="{{ url('account/kit-request') }}">{!! trans('questions.placeOrder') !!}</a>
        </div>
    </div>
    
</div>

@endsection