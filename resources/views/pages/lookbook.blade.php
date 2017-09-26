@extends('layouts.internal-pages')

@section('content')

<div class="layout-noPaddingContainer">
    
    <div class="leftMenu js-leftMenu">
        <p class="leftMenu-title">Archive</p>
        <ul class="leftMenu-menu">
            <li><a class="js-scrollToElement" href="#look-1">Ea eros id iusto iusto est</a></li>
            <li><a class="js-scrollToElement" href="#look-2">Humanitatis decima futurum dolore</a></li>
            <li><a class="js-scrollToElement" href="#look-3">Ea eros id iusto iusto est</a></li>
            <li><a class="js-scrollToElement" href="#look-4">Humanitatis decima futurum</a></li>
            <li><a class="js-scrollToElement" href="#look-5">Te tempor ullamcorper lobortis</a></li>
        </ul>
    </div><?php
    
    ?><div class="layout-rightBig">
        <h1 class="smallerMainTitle">{{ trans('lookbook.title') }}</h1>
        <p class="lead">{{ trans('lookbook.text') }}</p>
        
        <div class="listElementBlocks">
            <a class="listElementBlock" href="{{ url('/look-article') }}" id="look-1">
                <img class="listElement-image" src="/images/lookElement1.jpg" alt="">
                <h2 class="listElement-name">Option facer qui typi</h2>
            </a><?php
            
            ?><a class="listElementBlock" href="{{ url('/look-article') }}" id="look-2">
                <img class="listElement-image" src="/images/lookElement2.jpg" alt="">
                <h2 class="listElement-name">Possim est parum gothica</h2>
            </a><?php
            
            ?><a class="listElementBlock" href="{{ url('/look-article') }}" id="look-3">
                <img class="listElement-image" src="/images/lookElement3.jpg" alt="">
                <h2 class="listElement-name">Option facer qui typi</h2>
            </a><?php
            
            ?><a class="listElementBlock" href="{{ url('/look-article') }}" id="look-4">
                <img class="listElement-image" src="/images/lookElement1.jpg" alt="">
                <h2 class="listElement-name">Option facer qui typi</h2>
            </a><?php
            
            ?><a class="listElementBlock" href="{{ url('/look-article') }}" id="look-5">
                <img class="listElement-image" src="/images/lookElement2.jpg" alt="">
                <h2 class="listElement-name">Option facer qui typi</h2>
            </a>
        </div>
    </div>
    
</div>

@endsection