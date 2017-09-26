<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Tax;

class TaxesController extends Controller
{

    public function index()
    {
        $provinces = Province::all();
        return view('admin.taxes.index', compact('provinces'));
    }

    public function saveAll()
    {
        $ids = request('id');
        $keys = request('key');
        $percentages = request('percentage');

        for ($i = 0; $i < count($ids); $i++) {
            $tax = Tax::find($ids[$i]);
            $tax->key = $keys[$i];
            $tax->percentage = $percentages[$i];
            $tax->save();
        }

        return back();
    }

}
