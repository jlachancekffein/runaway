@extends('layouts.internal-pages')

@section('content')

    <div class="layout-container">
        <h1 class="mainTitle">{{ trans('kits.transactions') }}</h1>

        <h2 class="sectionTitle">{{ trans('kits.kitsList') }}</h2>

        @if ($readyKits->count() === 0 && $kits->count() === 0 && $sentKits->count() === 0)
            <p>{{ trans('kits.noKits') }}</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('kits.name') }}</th>
                    <th>{{ trans('kits.request') }}</th>
                    <th>{{ trans('kits.status') }}</th>
                    <th>{{ trans('kits.expireAt') }}</th>
                    <th>{{ trans('kits.tracking') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($readyKits as $kit)
                    <tr>
                        <td>{{ $kit->id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kit->customer->id) }}">{{ $kit->customer->name }}</a></td>
                        <td>{{ $kit->kitRequest ? $kit->kitRequest->name : '' }}</td>
                        <td>{{ trans('kits.' . $kit->status) }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="table-actions"><a href="/admin/kits/{{ $kit->id }}" class="button">{{ trans('kits.ship') }}</a></td>
                    </tr>
                @endforeach
                @foreach ($kits as $kit)
                    <tr>
                        <td>{{ $kit->id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kit->customer->id) }}">{{ $kit->customer->name }}</a></td>
                        <td>{{ $kit->kitRequest ? $kit->kitRequest->name : '' }}</td>
                        <td>{{ trans('kits.' . $kit->status) }}</td>
                        <td>{{ date('Y-m-d', strtotime($kit->expire_at)) }}</td>
                        <td>&nbsp;</td>
                        <td class="table-actions">
                            <form action="{{ url('admin/delete-kit/' . $kit->id) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="button-red">{{ trans('kits.deleteKit') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @foreach ($sentKits as $kit)
                    <tr>
                        <td>{{ $kit->id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kit->customer->id) }}">{{ $kit->customer->name }}</a></td>
                        <td>{{ $kit->kitRequest ? $kit->kitRequest->name : '' }}</td>
                        <td>{{ trans('kits.' . $kit->transaction->status) }}</td>
                        <td>&nbsp;</td>
                        <td><a style="text-decoration: underline;" href="{{ trans('kits.tracking_link', ['number' => $kit->transaction->tracking_number]) }}" target="_blank">{{ $kit->transaction->tracking_number }}</a></td>
                        <td class="table-actions">&nbsp;</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>

@endsection