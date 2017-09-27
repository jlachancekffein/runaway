@extends('layouts.internal-pages')

@section('content')

<div class="layout-noPaddingContainer">
    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
    <div class="leftMenu js-leftMenu">
        <p class="leftMenu-title">Archive</p>

        @foreach ($yearBlogs as $year => $seasonBlogs)
            <a class="leftMenu-subtitle js-scrollToElement" href="#year-{{ $year }}">{{ $year }}</a>
            <ul class="leftMenu-menu">
                @foreach ($seasonBlogs as $season => $blogs)
                    @foreach ($blogs as $blog)
                        <li><a class="js-scrollToElement" href="#blog-{{ $blog->seo_slug }}">{{ $blog->title }}</a></li>
                    @endforeach
                @endforeach
            </ul>
        @endforeach
    </div><?php
    
    ?><div class="layout-rightBig">
        <h1 class="mainTitle">{{ trans('blog.title') }}</h1>
        <p class="regularParagraph">{{ trans('blog.paragraph1') }}</p>
        <p class="regularParagraph">{{ trans('blog.paragraph2') }}</p>
        <p class="regularParagraph"><button class="article-header-btn" type="button" data-toggle="modal" data-target="#modal-newsletter">{{ trans('blog.link1') }}</button></p>
        <p class="regularParagraph">
            {{ trans('blog.link2') }}&nbsp;&nbsp;<?php
            ?><a href="{{ trans('general.facebook') }}" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php
            ?><a href="{{ trans('general.instagram') }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php
            ?><a href="{{ trans('general.pinterest') }}" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        </p>

        @foreach ($yearBlogs as $year => $seasonBlogs)
            @foreach ($seasonBlogs as $season => $blogs)
                <div class="dateHeader" id="year-{{ $year }}">
                    <div class="dateHeader-year">{{ $year }}</div><div class="dateHeader-season">{{ trans("date.$season") }}</div>
                </div>

                @foreach($blogs as $blog)
                    <a class="listElement" href="{{ url('/blog/' . $blog->seo_slug) }}" id="blog-{{ $blog->seo_slug }}">
                        <img class="listElement-image" src="{{ crop($blog->image, 300, 300) }}" alt="{{ $blog->title }}">
                        <div class="listElement-texts">
                            <h2 class="listElement-name">{{ $blog->title }}</h2>
                            <div class="listElement-date">{{ strftime('%e %B %Y', strtotime($blog->publication_date)) }}</div>
                            <p class="listElement-text">{{ $blog->description }}</p>
                        </div>
                    </a>
                @endforeach
            @endforeach
        @endforeach

    </div>
    
</div>

@endsection