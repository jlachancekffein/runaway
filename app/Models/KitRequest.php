<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KitRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'name',
        'budget',
        'comment',
    ];
    
    protected $dates = ['deleted_at'];
    
    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function kit()
    {
        return $this->hasOne('App\Models\Kit');
    }

}
