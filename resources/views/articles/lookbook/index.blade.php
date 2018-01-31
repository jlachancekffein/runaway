@extends('layouts.internal-pages')

@section('content')

<div class="layout-noPaddingContainer">

    <div class="leftMenu js-leftMenu">
        <p class="leftMenu-title">Archive</p>
        <ul class="leftMenu-menu">
            @foreach ($lookbooks as $look)
                @if (file_exists(storage_path(str_replace('/storage', 'app/public', $look->image))))
                    <li><a class="js-scrollToElement" href="#look-{{ $look->seo_slug }}">{{ $look->title }}</a></li>
                @endif
            @endforeach
        </ul>
    </div><?php

    ?><div class="layout-rightBig">
        <h1 class="tinyMainTitle">{{ trans('lookbook.title') }}</h1>
        <p class="lead">{{ trans('lookbook.text') }}</p>

        <div class="listElementBlocks">
            @foreach($lookbooks as $look)
                    <a class="listElementBlock" href="{{ url('/lookbook/' . $look->seo_slug) }}" id="look-{{ $look->seo_slug }}">
                        @if(in_array(strtolower(substr($look->image, -3)), array('jpg', 'png', 'gif')))
                            <img class="listElement-image" src="{{ crop($look->image, 227, 227) }}" alt="{{ $look->title }}">
                        @else
                            <img class="listElement-image" src="{{ $look->image }}" alt="{{ $look->title }}">
                        @endif
                        <h2 class="listElement-name">{{ $look->title }}</h2>
                    </a>
               
            @endforeach
        </div>
    </div>

</div>

@endsection
