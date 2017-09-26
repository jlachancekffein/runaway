<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    
    public function index($clientId)
    {
        $client = User::find($clientId);
        $name = $client->name;
        $preferences = (array) json_decode($client->preferences, true);
        
        $kits = $client->kits()->withTrashed()->with([
            'kitRequest' => function ($query) {
                $query->withTrashed();
            },
            'products' => function ($query) {
                $query->withTrashed();
            },
            'transaction'
        ])->get();
        
        foreach ($kits as $kit) {
            if ($kit->transaction) {
                $kit->finalStatus = 'transaction_' . $kit->transaction->status;
                
                
                $shippingAddress = $kit->transaction->getShippingAddress();
                $kit->transaction->shipping_address = $shippingAddress;
                
                $taxes = Tax::getTaxesForProvince($shippingAddress['province'], $kit->transaction->tax0, $kit->transaction->tax1);
                $kit->transaction->taxes = $taxes;
                
            } else {
                $kit->finalStatus = 'kit_' . $kit->status;
            }
        }
        
        return view('admin.client', compact('clientId', 'name', 'client', 'preferences', 'kits'));
    }
    
    public function outputPhoto($clientId) {
        $user = User::find($clientId);
        
        $photoName = md5($user->email . config('questions.secret_file_upload_key'));
        $path = '../storage/app/public/photos/' . $photoName . '.jpg';
        
        return response()->file($path);
    }
}
