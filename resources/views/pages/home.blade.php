
@extends('layouts.app')

@section('meta')
<meta name="description" content="home">
<meta name="keywords" content="home">
@endsection

@section('content')

<div class="fullwidthImage">
    <?php /*<img class="fullwidthImage-image" src="/images/home.jpg" alt="">*/ ?>
    
    <div class="videoContainer">
        <?php /*<div id="videoOverlay"></div>*/ ?>
        <video class="video js-video" width="560" height="315" autoplay muted loop>
            <source src="videos/home.mp4" type="video/mp4">
        </video>
        <?php /*<div id="homeVideo" class="video"></div>*/ ?>
        <?php /*<iframe id="homeVideo" class="video" width="560" height="315" src="https://www.youtube.com/embed/hK6f34Atc0M?autoplay=1&loop=1&playlist=hK6f34Atc0M&rel=0&controls=0&showinfo=0&enablejsapi=1" frameborder="0" allowfullscreen></iframe>*/ ?>
    </div>

    <div class="fullwidthImage-container">
        <a class="fullwidthImage-link buttonAnimated-black js-fullwidthImage-link" href="{{ url('/register') }}">
            <span class="<?php /* hidden-xs*/ ?>">{{ trans('home.getStarted') }}</span>
            <?php /*<span class="hidden-sm hidden-md hidden-lg">{{ trans('theme.getStarted') }}</span>*/ ?>
        </a>
    </div>
</div>

<div class="layout-container" id="how-it-works">
    <div class="layout-leftPadding">
        <h2 class="mainTitle">{{ trans('home.howItWorks') }}</h2>
        <p class="lead-uppercase">{!! trans('home.howItWorksText') !!}</p>
    </div>
</div>

<div class="howItWork">
    <div class="howItWork-content">
        <div class="howItWork-texts">
            <img class="howItWork-number" src="/images/howItWork-step1.png" alt="1">
            <h3 class="howItWork-title">{{ trans('home.howItWorkTitle1') }}</h3>
            <p class="howItWork-text">{{ trans('home.howItWorkText1') }}</p>
        </div><?php
        ?><img class="howItWork-image" src="/images/howItWork-1.jpg" alt="">
    </div>
</div>

<div class="howItWork-odd">
    <div class="howItWork-content">
        <div class="howItWork-texts">
            <img class="howItWork-number" src="/images/howItWork-step2.png" alt="2">
            <h3 class="howItWork-title">{{ trans('home.howItWorkTitle2') }}</h3>
            <p class="howItWork-text">{!! trans('home.howItWorkText2') !!}</p>
        </div><?php
        ?><img class="howItWork-image" src="/images/howItWork-2.jpg" alt="">
    </div>
</div>

<div class="howItWork">
    <div class="howItWork-content">
        <div class="howItWork-texts">
            <img class="howItWork-number" src="/images/howItWork-step3.png" alt="3">
            <h3 class="howItWork-title">{{ trans('home.howItWorkTitle3') }}</h3>
            <p class="howItWork-text">{!! trans('home.howItWorkText3') !!}</p>
        </div><?php
        ?><img class="howItWork-image" src="/images/howItWork-3.jpg" alt="">
    </div>
</div>

<div class="howItWork-buttons">
    <a class="howItWork-button" href="{{ url('/register/') }}">{{ trans('home.howItWorkLink1') }}</a><?php
    ?><p class="howItWork-paragraph">{{ trans('home.howItWorkLink2Text') }}<a href="{{ url('/how-it-works') }}">{{ trans('home.howItWorkLink2') }}</a>.</p>
</div>

<div class="layout-container">
    <div class="layout-leftPadding">
        <h2 class="mainTitle">{{ trans('home.whoAreWeTitle') }}</h2>
        <p class="lead-uppercase">{{ trans('home.whoAreWeText') }}</p>
    </div>
</div>

<div class="mosaic">
    <div class="mosaic-firstImage">
        <img src="/images/mosaic-firstImage-home.jpg" alt="">
    </div><?php
    ?><div class="mosaic-firstText">
        <p><strong class="mosaic-firstTextTitle">{{ trans('home.mosaicFirstTextTitle') }}</strong></p>
        {!! trans('home.mosaicFirstText') !!}
        <p><a href="{{ url('/stylist/') }}">{{ trans('home.mosaicFirstTextLink') }}</a></p>
    </div>
    
    <div class="mosaic-middleImage">
        <img src="/images/mosaic-middleImage-home.jpg" alt="">
    </div>
    
    <div class="mosaic-secondText"><?php /*<p>{{ trans('home.mosaicSecondText') }}</p>*/ ?></div><?php
    ?><div class="mosaic-secondImage">
        <img src="/images/mosaic-secondImage-home.jpg" alt="">
    </div>
</div>

<a class="lookbookTeaser" href="{{ url('/lookbook') }}">
    <div class="lookbookTeaser-textsAndImages">
        <div class="lookbookTeaser-texts">
            <h2 class="lookbookTeaser-title">{{ trans('home.getInspired') }}</h2><?php
            /* ?><p class="lookbookTeaser-text">{{ trans('home.discoverLookbook') }}</p><?php */ ?>
        </div>
        <div class="lookbookTeaser-images">
            <img src="/images/lookbookTeaser-images.jpg" alt="">
        </div>
    </div><?php
    ?><div class="lookbookTeaser-mainImage">
        <img src="/images/lookbookTeaser-mainImage.jpg" alt="">
    </div>
    <p class="lookbookTeaser-paragraph">{{ trans('home.getInspiredParagraph') }}</p>
    <p class="lookbookTeaser-paragraph-underlined">{{ trans('home.getInspiredLink') }}</p>
</a>

<div class="brands">
    <div class="brands-container">
        <h2 class="brands-title">{{ trans('home.brands') }}</h2><?php
        ?><p class="brands-text">{{ trans('home.brandsText') }}</p>
        <img class="brands-list" src="/images/brands-1.jpg" alt="Laurel | Luisa Cerano | Betty Barclay | Marccain | Taifun | [C]Studio | Js Collections"><?php
        ?><img class="brands-list" src="/images/brands-2.jpg" alt="Riani | Maison Marie Saint Pierre | Georges Rech | Ftc cashmere | Cambio | Samoon"><?php
        ?><img class="brands-list" src="/images/brands-3.jpg" alt="Margittes | 360 Sweater | Fabiana Filippi | Van Laack | Peter Reinwald | Eva & Claudi"><?php
        ?><img class="brands-list" src="/images/brands-4.jpg" alt="Windsor | Anette Görtz | Parakian Paris | Maerz | Katharina V. Braun | Raffaello Rossi">
    </div>
</div>

<div class="partners">
    <div class="partners-container">
        <h2 class="partners-title">{{ trans('home.partners') }}</h2><?php
        ?><p class="partners-text">{{ trans('home.partnersText') }}</p>
        <div class="partners-partnerList">
            <a class="partners-partner" href="https://www.marc-cain.com/" target="_blank"><img height="25" src="/images/partner-Marccain.svg" alt="Marccain"></a><?php
            ?><a class="partners-partner" href="http://groupecheikha.com/" target="_blank" style="top: -5px;"><img height="41" src="/images/partner-Cheikha.svg" alt="Cheïkha"></a><?php
            ?><a class="partners-partner" href="http://groupecheikha.com/fr/josee-laurent" target="_blank" style="top: -6px;"><img height="30" src="/images/partner-Josee-Laurent.svg" alt="Josée Laurent"></a><?php
            ?><a class="partners-partner" href="http://groupecheikha.com/fr/lentrepot" target="_blank" style="top: -5px;"><img height="41" src="/images/partner-Cheikha-entrepot.svg" alt="Cheïkha entrepot"></a><?php
            ?><a class="partners-partner" href="https://www.facebook.com/m0851quebec/" target="_blank"><img height="37" src="/images/partner-m0851.png" alt="m0851"></a><?php
            ?><a class="partners-partner" href="https://www.facebook.com/boutiqueurbain/" target="_blank"><img height="36" src="/images/partner-urbain.png" alt="Urbain | Prêt-à-porter"></a><?php
            ?><a class="partners-partner" href="https://www.berceau.ca/" target="_blank" style="top: -21px;"><img height="57" src="/images/partner-berceau.jpg" alt="Berceau | maternité + allaitement"></a>
        </div>
    </div>
</div>

@endsection