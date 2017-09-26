<?php

namespace App\Models;

use App\Collections\TaxCollection;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $guarded = [];

    public function newCollection(array $models = [])
    {
        return new TaxCollection($models);
    }

    public function setPercentageAttribute($percentage)
    {
        if ($percentage > 0) {
            $this->attributes['percentage'] = (float) $percentage;
        } else {
            $this->attributes['percentage'] = null;
        }
    }

    public function getFormattedPercentageAttribute()
    {
        if ($this->percentage) {
            return number_format($this->percentage, max(2, strlen(substr(strrchr(str_replace(',', '.', $this->percentage), "."), 1))));
        }

        return null;
    }
    
    // $tax0 et $tax1 servent si on ne veut pas recalculer les taxes d'une facture déjà payée par exemple.
    public static function getTaxesForProvince($provinceId, $tax0 = null, $tax1 = null) {
        $provinces = Province::with('taxes')->get();
        
        foreach ($provinces as $province) {
            if ($province->key == $provinceId) {
                $taxes = $province->taxes->pluck('percentage', 'key')->filter();
            }
        }
        
        if (!is_null($tax0)) {
            $index = 0;
            
            foreach ($taxes as $taxName => $taxPercentage) {
                if ($index == 0) {
                    $taxes[$taxName] = $tax0;
                }
                
                if ($index == 1 && !is_null($tax1)) {
                    $taxes[$taxName] = $tax1;
                }
                
                $index++;
            }
        }
        
        return $taxes;
    }
}
