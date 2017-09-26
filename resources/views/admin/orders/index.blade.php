@extends('layouts.internal-pages')

@section('content')
    <div class="container">
        <h1 class="mainTitle">{{ trans('orders.orders') }}</h1>

        <h2>{{ trans('orders.ordersList') }}</h2>

        @if (count($orders) === 0)
            <p>{{ trans('orders.noOrder') }}</p>
            <a class="btn btn-default" href="/admin/orders/create">{{ trans('orders.createFirstOrder') }}</a>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('orders.name') }}</th>
                        <th>{{ trans('orders.price') }}</th>
                        <th>{{ trans('orders.status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
