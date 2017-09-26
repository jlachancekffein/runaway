@extends('layouts.internal-pages')

@section('content')
    <div class="layout-container">
        <h1 class="mainTitle">{{ trans("articles.title_$section") }}</h1>

        <div>
            <a class="button" href="/admin/articles/{{ $section }}/create">{{ trans("articles.new_{$section}_button") }}</a>
        </div>

        <h2 class="sectionTitle">{{ trans("articles.title_{$section}_list") }}</h2>

        @if (count($articles) === 0)
            <p>{{ trans("articles.no_$section") }}</p>
        @else
            <div class="article">
                @foreach ($articles as $article)
                    @if ($article->image)
                    <a class="article-thumbnail" href="/admin/articles/{{ $section }}/{{ $article->id }}" style="width: 300px; height: 300px;">
                        <h3 class="article-title">{{ $article->title }}</h3>
                        @if (in_array(strtolower(substr($article->image, -3)), ['jpg', 'peg', 'png', 'gif']))
				<img src="{{ crop($article->image, 300, 300) }}" class="article-image">
			@endif
                    </a>
                    @else
                        <a class="article-thumbnail" href="/admin/articles/{{ $section }}/{{ $article->id }}" style="width: 300px; height: 300px; border: 1px solid #ccc;">
                            <h3 class="article-title">{{ $article->title }}</h3>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection
