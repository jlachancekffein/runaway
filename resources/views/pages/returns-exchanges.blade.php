@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('returns.title') }}</h1>
    </div>
</div>

<div class="terms">
    <div class="terms-section">
        <div class="terms-sectionTitleContainer">
            <h2 class="terms-sectionTitle">{{ trans('returns.generalTitle') }}</h2>
        </div>
        <div class="terms-sectionContent">{!! trans('returns.generalText') !!}</div>
    </div>
    
    <div class="terms-section">
        <div class="terms-sectionTitleContainer">
            <h2 class="terms-sectionTitle">{{ trans('returns.returnsTitle') }}</h2>
        </div>
        <div class="terms-sectionContent">{!! trans('returns.returnsText') !!}</div>
    </div>
    
    <div class="terms-section">
        <div class="terms-sectionTitleContainer">
            <h2 class="terms-sectionTitle">{{ trans('returns.refundsTitle') }}</h2>
        </div>
        <div class="terms-sectionContent">{!! trans('returns.refundsText') !!}</div>
    </div>
    
    <div class="terms-section">
        <div class="terms-sectionTitleContainer">
            <h2 class="terms-sectionTitle">{{ trans('returns.otherTitle') }}</h2>
        </div>
        <div class="terms-sectionContent">{!! trans('returns.otherText') !!}</div>
    </div>
</div>

@endsection