@extends('layouts.internal-pages')

@section('content')

<div class="layout-noPaddingContainer">

@if (URL::previous() != URL::current())
    <a class="backButton" href="{{ URL::previous() }}"></a>
@endif
    
    <div class="look">
        <h1 class="look-title">Option facer qui typi</h1>
        <div class="look-lead">Longue hendrerit in assum eleifend diam. Lius consequat ex lectorum etiam delenit. Minim imperdiet habent nunc ipsum tempor. Me iriure decima sollemnes eros qui.</div>
        
        <div class="look-value">
            <div class="look-valueLabel">Valeur de ce look</div><?php
            ?><div class="look-valueCosts">
                <div class="look-valueRegularCost">1475$</div>
                <div class="look-valuePromotionCost">1295$</div>
            </div>
        </div>
        
        <div class="clothing">
            <div class="clothing-image">
                <img src="http://www.placehold.it/449x449" alt="">
            </div><?php
            ?><div class="clothing-texts">
                <img class="clothing-brand" src="http://www.placehold.it/150x50" alt="">
                <h2 class="clothing-name">Le manteau blablabla avec col en fourrure de blablabla</h2>
                <p class="clothing-description">Ullamcorper videntur qui qui dolore ut. Iusto doming lius assum eleifend dolore. Mutationem hendrerit odio iis claritatem lorem. Duis eros accumsan qui dolore veniam. Gothica typi quod id quod at. Humanitatis quod non feugiat velit soluta. Ut option ad molestie putamus legere.</p>
            </div>
        </div>
        
        <div class="clothing">
            <div class="clothing-image">
                <img src="http://www.placehold.it/449x707" alt="">
            </div><?php
            ?><div class="clothing-texts">
                <img class="clothing-brand" src="http://www.placehold.it/150x50" alt="">
                <h2 class="clothing-name">Le manteau blablabla avec col en fourrure de blablabla</h2>
                <p class="clothing-description">Ullamcorper videntur qui qui dolore ut. Iusto doming lius assum eleifend dolore. Mutationem hendrerit odio iis claritatem lorem.</p>
            </div>
        </div>
        
        <div class="clothing">
            <div class="clothing-image">
                <img src="http://www.placehold.it/449x274" alt="">
            </div><?php
            ?><div class="clothing-texts">
                <img class="clothing-brand" src="http://www.placehold.it/150x50" alt="">
                <h2 class="clothing-name">Le manteau blablabla avec col en fourrure de blablabla</h2>
                <p class="clothing-description">Ullamcorper videntur qui qui dolore ut. Iusto doming lius assum eleifend dolore. Mutationem hendrerit odio iis claritatem lorem.</p>
            </div>
        </div>
    </div>
</div>

@endsection