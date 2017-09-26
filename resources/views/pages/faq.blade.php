@extends('layouts.internal-pages')

@section('content')

<div class="layout-noPaddingContainer">
    
    <div class="layout-rightLarge">
        <h1 class="mainTitle">{{ trans('faq.title') }}</h1>
        
        @foreach (array(
            'shipping' => array(
                'delay', 'carrier', 'shippingCost'
            ),
            'partners'=> array(
                'becomingPartner', 'partnersList', 'becomingStylist'
            ),
            'orders' => array(
                'fillFormEachOrder', 'dealersNotPartners', 'buyEveryItems', 'meetStylist'
            )
        ) as $section => $questions)
            
            <h2 class="sectionTitle" id="shipping">{{ trans('faq.'.$section.'Section') }}</h2>
            
            @foreach ($questions as $question)
                <div class="expandable">
                    <button type="button" class="expandable-button js-expandable-button">{{ trans('faq.'.$question.'Question') . trans('general.?') }}</button>
                    <div class="expandable-content">{!! trans('faq.'.$question.'Answer') !!}</div>
                </div>
            @endforeach
            
        @endforeach
        
    </div>
    
</div>

@endsection