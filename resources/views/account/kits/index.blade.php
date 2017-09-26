@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <div class="layout-leftPadding">
        <h1 class="mainTitle">{{ trans('kits.myKits') }}</h1>
    </div>
    
    <div class="row">
        <div class="layout-profileContainer">
            @include('partials.kitsList')
        </div>
    </div>
    <a href="{{ route('profile') }}" class="form-previous">{{ trans('account.backToProfile') }}</a>
</div>

@endsection
