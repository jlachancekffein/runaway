    @extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="smallMainTitle">{{ trans('kitRequests.title') }}</h1>
    </div>

    <form class="profile-form js-ajaxForm" action="{{ url()->current() }}" method="post" onsubmit="return false;" data-newTitle="{{ trans('kitRequests.confirmationTitle') }}">
        <div class="row">
            <div class="layout-profileContainer">
                {{ csrf_field() }}

                <div class="form-errors">
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="form-error">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>

                <p class="kitRequest-intro">{{ trans('kitRequests.budgetLabel') }}</p>
                
                <div class="form-field">
                    <label class="form-label" for="budgetField">{{ trans('kitRequests.intro') }}</label>
                    <select class="form-input js-select2" name="budget" id="budgetField">
                        @foreach (config('kit.budget') as $budget)
                            <option value="{{ $budget }}" {{ old('budget') == $budget ? 'selected="selected"' : '' }}>{{ trans("kitRequests.$budget") }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-field">
                    <label class="form-label" for="nameField">{{ trans('kitRequests.nameLabel') }}</label>
                    <p class="help-block">{{ trans('kitRequests.nameExample') }}</p>
                    <input class="form-input" id="nameField" name="name" type="text" value="{{ old('name') }}">
                </div>
                
                <div class="form-field">
                    <label class="form-label" for="commentField">{{ trans('kitRequests.commentLabel') }}</label>
                    <p class="help-block">{{ trans('kitRequests.commentExample') }}</p>
                    <textarea class="form-input" id="commentField" name="comment" placeholder="{{ trans('kitRequests.commentPlaceholder') }}">{{ old('comment') }}</textarea>
                </div>
                
                <div class="form-field">
                    <button type="submit" class="form-submitButton">{{ trans('kitRequests.submitButton') }}</button>
                </div>
            </div>
        </div>
        
    </form>
    
    <div class="form-success">
        <div class="question-finalStepImageMessageImage">
            <img style="width: 100%;" src="/images/getstarted.jpg" alt="">
        </div><?php
        
        ?><div class="question-finalStepImageMessageMessage">
            <div class="question-finalStepText">
                {!! trans('kitRequests.successMessage') !!}
                <img class="question-finalStepSignature" src="/images/mc-cheikha.jpg" alt="">
                <p>{{ trans('questions.finalStepFounder') }}</p>
            </div>
        </div>
    </div>
    
    <a href="{{ route('profile') }}" class="form-previous">{{ trans('account.backToProfile') }}</a>
</div>

@endsection