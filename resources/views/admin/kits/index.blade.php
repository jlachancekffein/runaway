@extends('layouts.internal-pages')

@section('content')

    <div class="layout-container">
        <h1 class="mainTitle">{{ trans('kits.kits') }}</h1>

        <a href="/admin/kits/create" class="button">{{ trans('kits.createNewKit') }}</a>

        <h2 class="sectionTitle">{{ trans('kits.kitRequest') }}</h2>

        @if ($kitRequests->count() === 0 && $kitDrafts->count() === 0)
            <p>{{ trans('kits.noKitRequest') }}</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('kits.name') }}</th>
                    <th>{{ trans('kits.request') }}</th>
                    <th>{{ trans('kits.budget') }}</th>
                    <th>{{ trans('kits.requestDate') }}</th>
                    <th width="35%">{{ trans('kits.commentary') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($kitDrafts as $kitDraft)
                    <tr>
                        <td>{{ $kitDraft->kit_id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kitDraft->user_id) }}">{{ $kitDraft->user_name }}</a></td>
                        <td>{{ $kitDraft->kit_request_name }}</td>
                        <td>{{ !empty($kitDraft->kit_request_budget) ? trans('kitRequests.' . $kitDraft->kit_request_budget) : '' }}</td>
                        <td>{{ $kitDraft->kit_request_created_at != '' ? date('Y-m-d', strtotime($kitDraft->kit_request_created_at)) : '' }}</td>
                        <td>{{ $kitDraft->kit_request_comment }}</td>
                        <td class="table-actions"><a href="/admin/kits/{{ $kitDraft->kit_id }}" class="button">{{ trans('kits.modify') }}</a></td>
                    </tr>
                @endforeach
                @foreach ($kitRequests as $kitRequest)
                    <tr>
                        <td>{{ $kitRequest->kit_request_id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kitRequest->user_id) }}">{{ $kitRequest->user_name }}</a></td>
                        <td>{{ $kitRequest->kit_request_name }}</td>
                        <td>{{ trans('kitRequests.' . $kitRequest->kit_request_budget) }}</td>
                        <td>{{ date('Y-m-d', strtotime($kitRequest->kit_request_created_at)) }}</td>
                        <td>{{ $kitRequest->kit_request_comment }}</td>
                        <td class="table-actions"><a href="/admin/kits/create/request/{{ $kitRequest->kit_request_id }}" class="button">{{ trans('kits.createKitForUser') }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

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
                    <th>{{ trans('cart.expressShipping') }}</th>
                    <th>{{ trans('kits.tracking') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($readyKits as $kit)
                    <tr>
                        <td>{{ $kit->kit_id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kit->user_id) }}">{{ $kit->user_name }}</a></td>
                        <td>{{ !empty($kit->kit_request_name) ? $kit->kit_request_name : '' }}</td>
                        <td>{{ trans('kits.' . $kit->kit_status) }}</td>
                        <td>&nbsp;</td>
                        <td>{{ $kit->transaction_express_shipping == config('ecommerce.express_shipping_cost') ? trans('general.yes') : trans('general.no') }}</td>
                        <td>&nbsp;</td>
                        <td class="table-actions"><a href="/admin/kits/{{ $kit->kit_id }}" class="button">{{ trans('kits.ship') }}</a></td>
                    </tr>
                @endforeach
                @foreach ($kits as $kit)
                    <tr>
                        <td>{{ $kit->kit_id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kit->user_id) }}">{{ $kit->user_name }}</a></td>
                        <td>{{ !empty($kit->kit_request_name) ? $kit->kit_request_name : '' }}</td>
                        <td>{{ trans('kits.' . $kit->kit_status) }}</td>
                        <td>{{ date('Y-m-d', strtotime($kit->kit_expire_at)) }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="table-actions">
                            <form action="{{ url('admin/delete-kit/' . $kit->kit_id) }}" method="post" onsubmit="return confirm('Voulez-vous supprimer ce look ?');">
                                {{ csrf_field() }}
                                <button type="submit" class="button-red">{{ trans('kits.deleteKit') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @foreach ($sentKits as $kit)
                    <tr>
                        <td>{{ $kit->kit_id }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kit->user_id) }}">{{ $kit->user_name }}</a></td>
                        <td>{{ !empty($kit->kit_request_name) ? $kit->kit_request_name : '' }}</td>
                        <td>{{ trans('kits.' . $kit->transaction_status) }}</td>
                        <td>&nbsp;</td>
                        <td>{{ $kit->transaction_express_shipping == config('ecommerce.express_shipping_cost') ? trans('general.yes') : trans('general.no') }}</td>
                        <td><a style="text-decoration: underline;" href="{{ trans('kits.tracking_link', ['number' => $kit->transaction_tracking_number]) }}" target="_blank">{{ $kit->transaction_tracking_number }}</a></td>
                        <td class="table-actions">&nbsp;</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>

@endsection