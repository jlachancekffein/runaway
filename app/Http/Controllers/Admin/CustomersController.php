<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KitRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    public function index()
    {
        $kitRequests = KitRequest::where('status', 'pending')->with('users')->get();
        $customers = User::paginate(30);

        return view('admin.customers.index', compact('kitRequests', 'customers'));
    }

    public function search(Request $request)
    {
        return User::searchCustomers($request->query('term'))->get()->transform(function ($user) {
            return ['text' => $user->text, 'id' => $user->id];
        });
    }

}
