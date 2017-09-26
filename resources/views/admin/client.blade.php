@extends('layouts.internal-pages')

@section('content')

<div class="layout-container">
    
    <h1 class="smallMainTitle">{{ $name }}</h1>
    
    <div class="client">
        @if (!empty($preferences['photo']))<?php
        ?><div class="client-inlineElement">
            <a href="/admin/images/photo-{{ $clientId }}.jpg" target="_blank"><img width="120" src="/admin/images/photo-{{ $clientId }}.jpg" alt=""></a>
        </div><?php
        ?>@endif<?php
        
        ?><div class="client-inlineElement">
            <div>
                <h2 class="client-label">{{ trans('printableSheet.contact') . trans('general.:') }}</h2>
                <div><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></div>
                <div>{{ $preferences['address'] }}</div>
                <div>{{ $preferences['city'] }}, {{ $preferences['province'] }}</div>
                <div style="text-transform: uppercase;">{{ $preferences['postal_code'] }}</div>
                <br>
                <div>{{ format_phone($preferences['phone']) }}</div>
                <div>{{ trans('questions.' . $preferences['contact_method']) }}</div>
                @if ($preferences['contact_method'] == 'phone')
                    <div>{{ trans('questions.' . $preferences['contact_hours']) }}</div>
                @endif
                @if (!empty($preferences['birthday']['year']))
                    <div><strong>Âge : </strong>{{ DateTime::createFromFormat('Y-m-d', $preferences['birthday']['year'] . '-' . $preferences['birthday']['month'] . '-' . $preferences['birthday']['day'], new DateTimeZone('America/Montreal'))->diff(new DateTime('now', new DateTimeZone('America/Montreal')))->y }} ans</div>
                @endif
            </div>
        </div><?php

        ?><div class="client-inlineElement">
            <div>
                <h2 class="client-label">{{ trans('printableSheet.hairColor') . trans('general.:') }}</h2>
                <div>{{ trans('questions.hairColor-' . $preferences['hairColor'][0]) }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.eyesColor') . trans('general.:') }}</h2>
                <div>{{ trans('questions.eyesColor-' . $preferences['eyeColor'][0]) }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.skinColor') . trans('general.:') }}</h2>
                <div>{{ trans('questions.skinColor-' . $preferences['skinColor'][0]) }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.piercedEars') . trans('general.:') }}</h2>
                <div>{{ trans('questions.' . ($preferences['piercedEars'][0] ? 'yes' : 'no')) }}</div>
            </div>
        </div><?php
        
        ?><div class="client-inlineElement">
            <div>
                <h2 class="client-label">{{ trans('printableSheet.bodyShape') . trans('general.:') }}</h2>
                <div>{{ trans('questions.bodyShape-' . $preferences['bodyShape'][0]) }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.height') . trans('general.:') }}</h2>
                <div>{{ floor($preferences['height']/12) . "' " . $preferences['height'] % 12 . '"' }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.weight') . trans('general.:') }}</h2>
                <div>{{ $preferences['weight'] . ' ' . trans('questions.' . $preferences['weightUnit'][0]) }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.shoeSize') . trans('general.:') }}</h2>
                <div>{{ $preferences['shoeSize'] }}</div>
            </div>
        </div><?php
        
        ?><div class="client-inlineElement">
            <div>
                <h2 class="client-label">{{ trans('printableSheet.shirtSize') . trans('general.:') }}</h2>
                <div>{{ $preferences['shirtSize'] }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.dressSize') . trans('general.:') }}</h2>
                <div>{{ $preferences['dressSize'] }}</div>
            </div>
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.pantsSize') . trans('general.:') }}</h2>
                <div>{{ $preferences['pantsSize'] }}</div>
            </div>
            
            <div>
                <div>
                    <h2 class="client-label">{{ trans('printableSheet.braSize') . trans('general.:') }}</h2>
                    <div style="text-transform: uppercase;">{{ $preferences['braBandSize'] . ' ' . $preferences['braCupSize'] }}</div>
                </div>
            </div>
        </div><?php
        
        ob_start();
        ?>@foreach (array('arms', 'legs', 'chest', 'belly', 'waist', 'buttocks', 'neck', 'knees') as $bodyPart)<?php
            ?>@if (array_key_exists('show' . ucfirst($bodyPart), $preferences) && $preferences['show' . ucfirst($bodyPart)][0] == 1)<?php
                ?><div>{{ trans('questions.' . $bodyPart) }}</div><?php
            ?>@endif<?php
        ?>@endforeach<?php
        $showBodyParts = ob_get_contents();
        ob_end_clean();
        
        if ($showBodyParts != '') {
            ?><div class="client-inlineElement">
                <h2 class="client-label">{{ trans('printableSheet.show') . trans('general.:') }}</h2>
                <?= $showBodyParts ?>
            </div><?php
        }
        
        ob_start();
        ?>@foreach (array('arms', 'legs', 'chest', 'belly', 'waist', 'buttocks', 'neck', 'knees') as $bodyPart)<?php
            ?>@if (array_key_exists('show' . ucfirst($bodyPart), $preferences) && $preferences['show' . ucfirst($bodyPart)][0] == 0)<?php
                ?><div>{{ trans('questions.' . $bodyPart) }}</div><?php
            ?>@endif<?php
        ?>@endforeach<?php
        $showBodyParts = ob_get_contents();
        ob_end_clean();
        
        if ($showBodyParts != '') {
            ?><div class="client-inlineElement">
                <h2 class="client-label">{{ trans('printableSheet.hide') . trans('general.:') }}</h2>
                <?= $showBodyParts ?>
            </div><?php
        }
        
        ?>@if (count($preferences['excludedPants']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.excludedPants') . trans('general.:') }}</h2>
            @foreach ($preferences['excludedPants'] as $excludedPants)<?php
                ?><div>{{ trans('questions.' . $excludedPants) }}</div><?php
            ?>@endforeach
        </div><?php
        ?>@endif<?php
        
        ?><div class="client-inlineElement">
            @if (count($preferences['excludedSkirts']))
            <div>
                <h2 class="client-label">{{ trans('printableSheet.excludedSkirts') . trans('general.:') }}</h2>
                @foreach ($preferences['excludedSkirts'] as $excludedSkirts)<?php
                    ?><div>{{ trans('questions.' . $excludedSkirts) }}</div><?php
                ?>@endforeach
            </div>
            @endif
            
            <div>
                <h2 class="client-label">{{ trans('printableSheet.favoritePants') . trans('general.:') }}</h2>
                @if ($preferences['favoritePants'][0] != 'les-deux')
                <div>{{ trans('questions.' . $preferences['favoritePants'][0]) }}</div>
                @else
                <div>{{ trans('questions.taille-haute') .', '. trans('questions.taille-basse') }}</div>
                @endif
            </div>
        </div><?php
        
        ?>@if (count($preferences['excludedTops']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.excludedTops') . trans('general.:') }}</h2>
            @foreach ($preferences['excludedTops'] as $excludedTops)<?php
                ?><div>{{ trans('questions.' . $excludedTops) }}</div><?php
            ?>@endforeach
        </div><?php
        ?>@endif<?php
        
        ?>@if (count($preferences['excludedNecks']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.excludedNecks') . trans('general.:') }}</h2>
            @foreach ($preferences['excludedNecks'] as $excludedNecks)<?php
                ?><div>{{ trans('questions.' . $excludedNecks) }}</div><?php
            ?>@endforeach
        </div><?php
        ?>@endif<?php
        
        ?><div class="client-inlineElement">
            @if (count($preferences['excludedClothes']))
            <div>
                <h2 class="client-label">{{ trans('printableSheet.excludedClothes') . trans('general.:') }}</h2>
                @foreach ($preferences['excludedClothes'] as $excludedClothes)<?php
                    ?><div>{{ trans('questions.' . $excludedClothes) }}</div><?php
                ?>@endforeach
            </div>
            @endif
            
            @if (count($preferences['favoriteClothes']))
            <div>
                <h2 class="client-label">{{ trans('printableSheet.favoriteClothes') . trans('general.:') }}</h2>
                <div>{{ trans('questions.' . $preferences['favoriteClothes'][0]) }}</div>
            </div>
            @endif
        </div><?php
        
        ?>@if (count($preferences['favoritePatterns']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.favoritePatterns') . trans('general.:') }}</h2>
            <div>
            @foreach ($preferences['favoritePatterns'] as $favoritePatterns)<?php
                ?><div>{{ trans('questions.favoritePatterns-' . $favoritePatterns) }}</div><?php
            ?>@endforeach
            </div>
        </div><?php
        ?>@endif<?php
        
        ?>@if (count($preferences['favoriteAccessories']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.favoriteAccessories') . trans('general.:') }}</h2>
            <div class="client-container">
                <div class="client-inlineElement">
                    @foreach ($preferences['favoriteAccessories'] as $index => $favoriteAccessories)
                        @if ($index % 5 == 4 && $index != 0)
                        </div><div class="client-inlineElement"><?php
                        ?>@endif
                            
                        <div>{{ trans('questions.favoriteAccessories-' . $favoriteAccessories) }}</div>
                    @endforeach
                </div>
            </div>
        </div><?php
        ?>@endif<?php
        
        ?>@if (count($preferences['styles']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('questions.title-1') }}</h2>
            <div class="client-container">
                <div class="client-inlineElement">
                    @foreach ($preferences['styles'] as $index => $styles)
                        @if ($index % 5 == 4 && $index != 0)
                        </div><div class="client-inlineElement"><?php
                        ?>@endif
                            
                        <div>{{ trans('questions.style-' . $styles) }}</div>
                    @endforeach
                </div>
            </div>
        </div><?php
        ?>@endif<?php
        
        ?>@if (!empty($preferences['brand']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.favoriteBrands') . trans('general.:') }}</h2>
            <div class="client-container">
                <div class="client-inlineElement">
                    @foreach ($preferences['brand'] as $index => $brand)
                        @if ($index % 5 == 4 && $index != 0)
                        </div><div class="client-inlineElement"><?php
                        ?>@endif
                            
                        <div>{{ trans('questions.' . $brand) }}</div>
                    @endforeach
                </div>
            </div>
        </div><?php
        ?>@endif<?php
        
        ?>@if ($preferences['allergies'] != '')<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.allergies') . trans('general.:') }}</h2>
            <div>{{ $preferences['allergies'] }}</div>
        </div><?php
        ?>@endif<?php
        
        ?>@if (count($preferences['excludedColors']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.excludedColors') . trans('general.:') }}</h2>
            <div>
                {{ implode(', ', array_map(function($a){
                    return trans('questions.color-' . $a);
                }, $preferences['excludedColors'])) }}
            </div>
        </div><?php
        ?>@endif<?php
        
        ?>@if (count($preferences['favoriteColors']))<?php
        ?><div class="client-inlineElement">
            <h2 class="client-label">{{ trans('printableSheet.favoriteColors') . trans('general.:') }}</h2>
            <div>
                {{ implode(', ', array_map(function($a){
                    return trans('questions.color-' . $a);
                }, $preferences['favoriteColors'])) }}
            </div>
        </div><?php
        ?>@endif
    </div>
    
    <hr>
    
    <div class="smallMainTitle">{{ trans('kits.kits') }}</div>
    <br>
    
    <table class="table clientKits" cellpadding="0" cellspacing="0" border="0" width="100%">
        <thead>
            <tr>
                <th>{{ trans('kits.photo') }}</th>
                <th>{{ trans('kits.status') }}</th>
                <th>{{ trans('kits.createdDate') }}</th>
                <th>{{ trans('kits.expirationDate') }}</th>
                <th>{{ trans('kits.deletedDate') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kits as $kit)
                <tr class="openableKit js-openableKit">
                    <td><img width="100" src="/storage/{{ $kit->photo }}" alt=""></td>
                    <td>{{ trans('customers.status_' . $kit->finalStatus) }}</td>
                    <td>{{ date('Y-m-d', strtotime($kit->created_at)) }}</td>
                    <td>{{ date('Y-m-d', strtotime($kit->expire_at)) }}</td>
                    <td>{{ !is_null($kit->deleted_at) ? date('Y-m-d', strtotime($kit->deleted_at)) : '' }}</td>
                </tr>
                <tr class="openableKit-content">
                    <td colspan="5" style="padding-bottom: 50px;"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                        @if ($kit->kitRequest)
                        <tr>
                            <td class="openableKit-contentTitle">{{ trans('kits.request') }}</td>
                        </tr>
                        <tr>
                            <td><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td><strong>{{ trans('kits.requestName') }}&nbsp;:&nbsp;</strong>{{ $kit->kitRequest->name }}</td>
                                    <td><strong>{{ trans('kits.requestBudget') }}&nbsp;:&nbsp;</strong>{{ trans('kitRequests.' . $kit->kitRequest->budget) }}</td>
                                    <td><strong>{{ trans('kits.requestDate') }}&nbsp;:&nbsp;</strong>{{ date('Y-m-d', strtotime($kit->kitRequest->created_at)) }}</td>
                                    <td style="max-width: 500px;"><strong>{{ trans('kits.commentary') }}&nbsp;:&nbsp;</strong>{{ $kit->kitRequest->comment }}</td>
                                </tr>
                            </table></td>
                        </tr>
                        @else
                        <tr>
                            <td>{{ trans('kits.noRequest') }}</td>
                        </tr>
                        @endif
                        
                        <tr>
                            <td class="openableKit-contentTitle" style="padding-top: 15px;">{{ trans('kits.products') }}</td>
                        </tr>
                        <tr>
                            <td><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                @foreach ($kit->products as $product)
                                <tr{!! $kit->transaction && is_null($product->transaction_id) ? ' class="strike-product"' : '' !!}>
                                    <td><strong>{{ trans('kits.name') }}&nbsp;:&nbsp;</strong>{{ $product->name }}</td>
                                    <td><strong>{{ trans('kits.brand') }}&nbsp;:&nbsp;</strong>{{ $product->brand }}</td>
                                    <td{!! $product->reduced_price != 0 ? ' style="text-decoration: line-through;"' : '' !!}><strong>{{ trans('kits.regular_price') }}&nbsp;:&nbsp;</strong>{{ $product->regular_price }}</td>
                                    <td>
                                        @if ($product->reduced_price != 0)
                                        <strong>{{ trans('kits.reduced_price') }}&nbsp;:&nbsp;</strong>{{ $product->reduced_price }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table></td>
                        </tr>
                        
                        @if ($kit->transaction)
                        <tr>
                            <td class="openableKit-contentTitle" style="padding-top: 15px;">{{ trans('kits.transaction') }}</td>
                        </tr>
                        <tr>
                            <td><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-bottom: 5px;"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td><strong>{{ trans('kits.subtotal') }}&nbsp;:&nbsp;</strong>{{ $kit->transaction->subtotal }}</td>
                                            <td><strong>{{ trans('kits.express_shipping') }}&nbsp;:&nbsp;</strong>{{ $kit->transaction->express_shipping != 0 ? trans('general.yes') : trans('general.no') }}</td>
                                            @foreach ($kit->transaction->taxes as $taxName => $taxValue)
                                            <td><strong>{{ $taxName }}&nbsp;:&nbsp;</strong>{{ $taxValue }}</td>
                                            @endforeach
                                            <td><strong>{{ trans('kits.total') }}&nbsp;:&nbsp;</strong>{{ $kit->transaction->total }}</td>
                                            <td><strong>{{ trans('kits.paidDate') }}&nbsp;:&nbsp;</strong>{{ date('Y-m-d', strtotime($kit->transaction->created_at)) }}</td>
                                        </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                    <td><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td style="vertical-align: top;"><strong>{{ trans('kits.shippingAddress') }}&nbsp;:&nbsp;</strong><?php
                                                ?><span style="display: inline-block; vertical-align: top;">
                                                    {{ $kit->transaction->shipping_address['address'] }}<br>
                                                    {{ $kit->transaction->shipping_address['city'] }}, {{ $kit->transaction->shipping_address['province'] }}<br>
                                                    <span style="text-transform: uppercase;">{{ $kit->transaction->shipping_address['postal_code'] }}</span>
                                                </span>
                                            </td>
                                            <td style="vertical-align: top;">
                                                <strong>{{ trans('kits.trackingNumber') }}&nbsp;:&nbsp;</strong>
                                                @if ($kit->transaction->tracking_number != '')
                                                <a style="text-decoration: underline;" href="{{ trans('kits.tracking_link', ['number' => $kit->transaction->tracking_number]) }}" target="_blank">{{ $kit->transaction->tracking_number }}</a>
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td style="vertical-align: top;"><strong>{{ trans('kits.stripe') }}&nbsp;:&nbsp;</strong>{{ $kit->transaction->stripe_transaction_id }}</td>
                                        </tr>
                                    </table></td>
                                </tr>
                            </table></td>
                        </tr>
                        @endif
                    </table></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="javascript:;" onclick="window.history.back();" class="form-previous2">{{ trans('account.back') }}</a>
</div>
<style>
@media print {
    .navbar,
    .subheader,
    .footer,
    .form-previous2 { display: none; }
    
    body { padding-top: 0; }
    
    .layout-container { width: auto; }
}
</style>

@endsection
