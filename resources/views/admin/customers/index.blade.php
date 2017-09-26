@extends('layouts.internal-pages')

@section('content')
    <div class="container">
        <h1 class="mainTitle">{{ trans('customers.title') }}</h1>

        @if ($customers->count() === 0)
            <p>{{ trans('customers.noCustomers') }}</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('customers.name') }}</th>
                    <th>{{ trans('customers.email') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td><img class="avatar-image" src="{{ $customer->avatar }}" alt=""> {{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td class="table-actions"><a href="{{ url('admin/kits/create') }}" class="btn btn-default">{{ trans('customers.createKit') }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $customers->links() }}
        @endif
    </div>
@endsection
