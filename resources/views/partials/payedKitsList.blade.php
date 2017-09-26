@if (count($payedKits) > 0)
<ul class="kitsList">
    @foreach ($payedKits as $kit)
    <li class="kitsList-kit {{ $kit->status === 'pending' ? 'kitsList-kit-new' : '' }}">
        <a class="kitsList-link" href="/account/kits/{{ $kit->id }}">
            <img class="kitsList-image" src="{{ asset("storage/$kit->photo") }}">
            <div class="kitsList-name">
                @if (!empty($kit->kitRequest))
                    {{ $kit->kitRequest->name . ' - '  }}
                @endif
                {{ trans('kits.client-' . $kit->transaction->status) }}
            </div>
        </a>
    </li>
    @endforeach
</ul>
@endif