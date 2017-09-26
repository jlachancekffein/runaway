@extends('layouts.internal-pages')

@section('content')

    <div class="layout-container">
        <h1 class="mainTitle">{{ trans('kits.createKitTitle') }}</h1>
        <form class="kits-form" action="/admin/kits/create" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            @if (isset($kitRequest))
                <input type="hidden" name="kit_request_id" value="{{ $kitRequest->id }}">
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
            @endif

            @if (count($errors) > 0)
                <div class="form-errors">
                    @foreach ($errors->all() as $error)
                        <div class="form-error">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="adminForm-group">
                <label class="kits-label" for="customerField">{{ trans('kits.customerLabel') }}</label>
                @if (isset($customer))
                    <p>
                        <strong>{{ trans('kits.name') . trans('general.:') }} </strong><a style="text-decoration: underline;" href="{{ url('admin/client/' . $kitRequest->customer->id) }}">{{ $customer->name }}</a><br>
                        <strong>{{ trans('kits.email') . trans('general.:') }} </strong>{{ $customer->email }}
                        @if (isset($kitRequest))
                            <br>
                            <strong>{{ trans('kits.kitName') . trans('general.:') }} </strong>{{ $kitRequest->name }}<br>
                            <strong>{{ trans('kits.budget') . trans('general.:') }} </strong>{{ trans("kitRequests.$kitRequest->budget") }}
                            @if (!empty($kitRequest->comment))
                                <br>
                                <strong>{{ trans('kits.additionalInformations') . trans('general.:') }} </strong>{{ $kitRequest->comment }}
                            @endif
                        @endif
                    </p>
                @else
                    <select class="js-memberSearch form-control" id="customerField" name="customer_id" placeholder="{{ trans('kits.selectUser') }}"></select>
                @endif
            </div>

            <div class="adminForm-group kits-photoContainer js-kits-photoContainer">
                <label class="kits-label" for="photoField">{{ trans('kits.photoLabel') }}</label>
                <input class="kits-photoInput js-kits-photoInput" id="photoField" name="photo" type="file">
            </div>
            <label class="kits-label js-kits-editImageLabel" for="photoField">Téléversez une nouvelle photo</label>

            <div class="adminForm-group">
                <label for="statusField">{{ trans('kits.status') }}</label>
                <select class="form-control js-kits-status" name="status" id="statusField">
                    @foreach($actions as $statusKey)
                        <option value="{{ $statusKey }}">{{ trans('kits.action-' .$statusKey) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="adminForm-group">
                <button type="submit" class="question-submit js-kits-submitButton">{{ trans('kits.submitButton') }}</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script type="text/template" id="markerTemplate">
        @include('admin.partials.marker')
    </script>
@endpush