@extends('layouts.internal-pages')

@section('content')

<div class="layout-container" style="margin-bottom: 20px;">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('terms.title') }}</h1>
    </div>
</div>

<div class="layout-container">
    <div class="layout-rightLessLarge">
        <p class="regularParagraph">{{ trans('terms.paragraph1') }}</p>
        <p class="regularParagraph">{{ trans('terms.paragraph2') }}</p>
        <br>
        <p class="regularParagraph"><strong>{{ trans('terms.title1') }}</strong></p>
        <p class="regularParagraph">{{ trans('terms.paragraph3') }}</p>
        <p class="regularParagraph">{{ trans('terms.paragraph4') }}</p>
        <p class="regularParagraph">{{ trans('terms.paragraph5') }}</p>
        <br>
        <p class="regularParagraph"><strong>{{ trans('terms.title2') }}</strong></p>
        <p class="regularParagraph">{{ trans('terms.paragraph6') }}</p>
        <p class="regularParagraph">{{ trans('terms.paragraph7') }}</p>
        <br>
        <p class="regularParagraph"><strong>{{ trans('terms.title3') }}</strong></p>
        <p class="regularParagraph">{{ trans('terms.paragraph8') }}</p>
        <p class="regularParagraph">{{ trans('terms.paragraph9') }}</p>
        <br>
        <p class="regularParagraph"><strong>{{ trans('terms.title4') }}</strong></p>
        <p class="regularParagraph">{{ trans('terms.paragraph10') }}</p>
        <br>
        <p class="regularParagraph"><strong>Runway 2 Doorway</strong></p>
        <p class="regularParagraph">{!! trans('terms.r2dAddress') !!}<br>
        {{ trans('terms.r2dEmail') }} <a href="mailto:{{ trans('general.r2dEmail') }}">{{ trans('general.r2dEmail') }}</a></p>
    </div>
</div>

@endsection