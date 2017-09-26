<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{

    public function scopePaid()
    {
        return $this->where('status', 'paid');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function kit()
    {
        return $this->belongsTo('App\Models\Kit');
    }
    
    public function getShippingAddress() {
        if ($this->shipping_address == 'contact') {
            $preferences = (array) json_decode(User::find($this->customer_id)->preferences, true);
            
            $shippingAddress = [
                'address' => $preferences['address'],
                'city' => $preferences['city'],
                'province' => $preferences['province'],
                'postal_code' => $preferences['postal_code'],
            ];

        } else {
            $shippingAddressFromBD = DB::table('addresses')
                ->leftJoin('transactions', function($join) {
                    $join->on('transactions.customer_id', '=', 'addresses.customer_id');
                    $join->on('transactions.shipping_address', '=', 'addresses.address_id');
                })
                ->where('addresses.customer_id', $this->customer_id)
                ->where('transactions.id', $this->id)
                ->get();

            $shippingAddressFromBD = $shippingAddressFromBD[0];

            $shippingAddress = [
                'address' => $shippingAddressFromBD->address,
                'city' => $shippingAddressFromBD->city,
                'province' => $shippingAddressFromBD->province,
                'postal_code' => $shippingAddressFromBD->postal_code
            ];
        }
        
        return $shippingAddress;
    }
}
