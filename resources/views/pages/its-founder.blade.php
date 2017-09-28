@extends('layouts.internal-pages')

@section('content')

<div class="layout-container" style="margin-bottom: 20px;">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('stylist.title') }}</h1>
    </div>
</div>

<div class="layout-container">
    <div class="layout-rightLessLarge">
        <p class="regularParagraph">{{ trans('stylist.paragraph1') }}</p>
        <p class="regularParagraph">{{ trans('stylist.paragraph2') }}</p>
        <p class="regularParagraph">{{ trans('stylist.paragraph3') }}</p>
        <p class="regularParagraph">{{ trans('stylist.paragraph4') }}</p>
        <p class="regularParagraph">{{ trans('stylist.paragraph5') }}</p>
        <p class="regularParagraph">{{ trans('stylist.paragraph6') }}</p>
        <p class="regularParagraph">{{ trans('stylist.paragraph7') }}</p>
        <p class="regularParagraph">{{ trans('stylist.paragraph8') }}</p>
    </div>
</div>

@endsection