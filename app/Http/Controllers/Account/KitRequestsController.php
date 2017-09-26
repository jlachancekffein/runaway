<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKitRequestRequest;
use App\Models\KitRequest;
use Auth;
use Illuminate\Support\Facades\Mail;

class KitRequestsController extends Controller
{

    public function form()
    {
        return view('account.kit_requests.form');
    }

    public function store(StoreKitRequestRequest $request)
    {
        $kitRequest = KitRequest::create($request->input());
        $kitRequest->customer_id = Auth::user()->id;
        $kitRequest->save();
        
        $customerName = Auth::user()->name;
        
        $name = $request->input('name');
        
        $data = array(
            'budget' => trans('kitRequests.' . $request->input('budget')),
            'name' => $name,
            'comment' => $request->input('comment'),
            'link' => url('/admin/kits/create/request/' . $kitRequest->id)
        );
        
        Mail::send(['emails.kitRequest', 'emails.kitRequest-plain'], $data, function ($m) use($customerName) {
            $m->to(trans('general.r2dEmail'), 'Runway 2 Doorway')->subject(trans('kitRequests.emailSubject', ['name' => $customerName]));
        });

        session()->flash('status', trans('kitRequests.successMessage'));
        
        // if ($request->ajax()) {
        //     return array('redirect' => route('profile'));
        // }

        // return redirect()->route('profile');
    }

}
