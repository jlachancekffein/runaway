@if (count($kits) > 0)
<ul class="kitsList">
    @foreach ($kits as $kit)
    <li class="kitsList-kit {{ $kit->status === 'pending' ? 'kitsList-kit-new' : '' }}">
        <a class="kitsList-link" href="/account/kits/{{ $kit->id }}">
            <img class="kitsList-image" src="{{ asset("storage/$kit->photo") }}">
            <div class="kitsList-name">
                @if (!empty($kit->kitRequest))
                    {{ $kit->kitRequest->name . ' - '  }}
                @endif
                {{ trans('kits.client-' . $kit->status) }}
            </div>
            <div class="kitsList-date">{{ trans('kits.limitDate') . trans('general.:') . ' ' . date('Y-m-d', strtotime($kit->expire_at)) }}</div>
        </a>
    </li>
    @endforeach
</ul>
@endif