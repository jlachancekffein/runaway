<?php

namespace App\Collections;

use App\Models\Province;
use Illuminate\Database\Eloquent\Collection;

class ProductCollection extends Collection
{

    private $askedForExpressShipping = false;

    public function getSubtotal()
    {
        return $subtotal = $this->sum('price');
    }

    public function getTaxes(Province $province)
    {
        return $province->taxes->validTaxes()->getPrices($this->getSubtotal() + $this->getShippingCost());
    }

    public function getTotal(Province $province)
    {
        $subtotal = $this->getSubtotal();
        $expressShipping = $this->getShippingCost();
        $taxes = $this->getTaxes($province)->sum();
        return $subtotal + $expressShipping + $taxes;
    }

    public function getExpressShipping()
    {
        return $this->askedForExpressShipping ? config('ecommerce.express_shipping_cost') : 0;
    }
    
    public function getShippingCost()
    {
        $express_cost = $this->getExpressShipping();
        return $express_cost != 0 ? $express_cost : config('ecommerce.shipping_cost');
    }

    public function setExpressShipping($expressShipping)
    {
        $this->askedForExpressShipping = (boolean) $expressShipping;
    }
}
