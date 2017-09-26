<?php

namespace App\Models;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'avatar',
        'language',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function getProvince()
    {
        $preferences = json_decode($this->preferences);
        return $preferences['province'];
    }

    public function scopeSearchCustomers($query, $searchTerms)
    {
        $query->where('role', 'member');

        if (!$searchTerms) {
            return $query;
        }

        $query->where(function ($query) use ($searchTerms) {
            foreach (explode(' ', $searchTerms) as $word) {
                $query->where('name', 'LIKE', "%$word%")
                      ->orWhere('email', 'LIKE', "%$word%");
            }
        });

        return $query;
    }

    public function getProvinceCodeAttribute()
    {
        if (empty(json_decode($this->preferences, true)['province'])) {
            return '';
        }

        return strtoupper([
            'alberta' => 'ab',
            'british-columbia' => 'bc',
            'manitoba' => 'mb',
            'new-brunswick' => 'nb',
            'newfoundland-and-labrador' => 'nl',
            'northwest-territories' => 'nt',
            'nova-scotia' => 'ns',
            'nunavut' => 'nu',
            'ontario' => 'on',
            'prince-edward-island' => 'pe',
            'quebec' => 'qc',
            'saskatchewan' => 'sk',
            'yukon' => 'yt',
        ][json_decode($this->preferences, true)['province']]);
    }

    public function getTextAttribute()
    {
        return "$this->name ($this->email)";
    }
    
    public function mergePreferences($formPreferences)
    {
        $userPreferences = (array) json_decode($this->preferences);
        $this->preferences = json_encode(array_merge($userPreferences, (array) $formPreferences));
    }

    public function kitRequests()
    {
        return $this->hasMany('App\Models\KitRequest', 'customer_id');
    }

    public function kits()
    {
        return $this->hasMany('App\Models\Kit', 'customer_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'customer_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'customer_id');
    }

}
