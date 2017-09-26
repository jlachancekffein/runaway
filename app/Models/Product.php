<?php

namespace App\Models;

use App\Collections\ProductCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kit_id',
        'name',
        'regular_price',
        'reduced_price',
        'marker_x',
        'marker_y',
        'brand'
    ];
    
    protected $dates = ['deleted_at'];

    public function kit()
    {
        return $this->belongsTo('App\Models\Kit');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }

    public function setRegularPriceAttribute($value)
    {
        $this->attributes['regular_price'] = (float)str_replace(',', '.', $value);
    }

    public function setReducedPriceAttribute($value)
    {
        $this->attributes['reduced_price'] = (float)str_replace(',', '.', $value);
    }

    public function newCollection(array $models = [])
    {
        return new ProductCollection($models);
    }

    public function getPriceAttribute()
    {
        if ($this->reduced_price > 0) {
            return $this->reduced_price;
        }

        return $this->regular_price;
    }

}