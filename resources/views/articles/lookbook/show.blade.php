@extends('layouts.internal-pages')

@section('content')

<div class="layout-noPaddingContainer">

@if (URL::previous() != URL::current())
    <a class="backButton" href="{{ URL::previous() }}"></a>
@endif

    <div class="blog">
        <h1 class="blog-title">{{ $article->title }}</h1>

        @foreach ($article->content as $content)
            @include('articles.blocks.' . $content['templateId'], compact($content))
        @endforeach
    </div>
</div>

@endsection