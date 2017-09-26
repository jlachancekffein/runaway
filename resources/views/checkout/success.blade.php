@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    <h1 class="mainTitle">{{ trans('cart.paymentSucceedTitle') }}</h1>
    <p class="lead">{{ trans('cart.paymentSucceedText') }}</p>
</div>

@endsection
