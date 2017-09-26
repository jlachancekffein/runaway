<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kit;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Les kits vendus
        $readyKits = Kit::select('kits.*')
            ->with(['customer', 'kitRequest'])
            ->leftJoin('kit_requests', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->leftJoin('transactions', function($join) {
                $join->on('transactions.kit_id', '=', 'kits.id');
            })
            // ->where('kit_requests.status', 'answered')
            ->where('kits.status', 'sold')
            ->where('transactions.status', 'paid')
            ->get();
        
        // Les kits pas vendus
        $kits = Kit::select('kits.*')
            ->with(['customer', 'kitRequest'])
            ->leftJoin('kit_requests', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->leftJoin('transactions', function($join) {
                $join->on('transactions.kit_id', '=', 'kits.id');
            })
            ->where('kit_requests.status', 'answered')
            ->where('kits.status', '<>', 'sold')
            ->whereNull('transactions.kit_id')
            ->get();
        
        // Les kits expédiés
        $sentKits = Kit::select('kits.*')
            ->with(['customer', 'kitRequest'])
            ->leftJoin('kit_requests', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->leftJoin('transactions', function($join) {
                $join->on('transactions.kit_id', '=', 'kits.id');
            })
            ->where('kit_requests.status', '=', 'answered')
            ->where('transactions.status', '<>', 'paid')
            ->get();
        
        return view('admin.transactions.index', compact('kits', 'readyKits', 'sentKits'));
    }
}
