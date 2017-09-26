<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'kit_request_id',
        'photo',
        'status',
        'expire_at',
    ];
    
    protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function kitRequest()
    {
        return $this->belongsTo('App\Models\KitRequest');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction');
    }

    public function getCustomerId() {
        return $this->customer_id;
    }

    public function unsoldProducts()
    {
        if ($this->status !== 'sold') {
            return $this->products;
        }

        return $this->products->filter(function($value){
            return $value->transaction_id;
        });
    }
}
