<?php

namespace App\Http\ViewComposers;


use App\Models\Kit;
use App\Models\KitRequest;
use App\Models\Transaction;
use Auth;
use Illuminate\View\View;

class KitRequestsCounterComposer
{

    public function compose(View $view)
    {
        if (!Auth::guest() && Auth::user()->role === 'admin') {
            $view->with('kitRequestsCount',
                    KitRequest::where('status', 'pending')
                        ->count()
                    +
                    Kit::where('kits.status', 'draft')
                        ->leftJoin('kit_requests', function($join) {
                            $join->on('kit_requests.id', '=', 'kits.kit_request_id');
                        })
                        ->whereNull('kit_requests.id')
                        ->count()
                );
            $view->with('transactionsCount', Transaction::where('status', 'paid')->count());
        }
    }

}