<?php

namespace App\Collections;

use App\Models\Tax;
use Illuminate\Database\Eloquent\Collection;

class TaxCollection extends Collection
{

    public function validTaxes()
    {
        return $this->filter(function (Tax $tax) {
            return !empty($tax->key);
        });
    }

    public function getPrices($subtotal)
    {
        return $this->each(function (Tax $tax) use ($subtotal) {
            $tax->price = $tax->percentage * $subtotal;
        })->pluck('price', 'key');
    }

}