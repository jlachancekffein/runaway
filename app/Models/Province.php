<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [];

    public function taxes()
    {
        return $this->hasMany('App\Models\Tax');
    }
}
