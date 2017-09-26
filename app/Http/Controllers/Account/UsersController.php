<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UpdateAddressBookRequest;
use App\Http\Requests\UpdatePassword;
use App\Models\Address;
use App\Models\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{

    public function profile()
    {
        if (Auth::guest() || Auth::user()->role !== 'admin') {
            $user = 'guest';
            // $kits = Kit::where('customer_id', Auth::user()->id)
            $kits = Kit::select('kits.*')
                ->where('customer_id', Auth::user()->id)
                ->where('status', '!=', 'draft')
                ->where('status', '!=', 'sold')
                ->with('kitRequest')
                ->orderBy('created_at', 'desc')
                ->get();
            
            // $payedKits = Kit::where('customer_id', Auth::user()->id)
            $payedKits = Kit::select('kits.*')
                ->where('customer_id', Auth::user()->id)
                ->where('status', '!=', 'draft')
                ->where('status', 'sold')
                ->with('kitRequest')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('users.profile', compact('user', 'kits', 'payedKits'));
        } else {
            $user = 'admin';
            
            return view('users.profile', compact('user'));
        }
    }
    
    public function addressBook()
    {
        $user = Auth::user();
        $preferences = (array) json_decode($user->preferences, true);
        
        $addresses = DB::table('addresses')->select('*')->where('customer_id', $user->id)->get();
        
        $provinces = array(
            'alberta' => trans('general.alberta'),
            'british-columbia' => trans('general.british-columbia'),
            'manitoba' => trans('general.manitoba'),
            'new-brunswick' => trans('general.new-brunswick'),
            'newfoundland-and-labrador' => trans('general.newfoundland-and-labrador'),
            'northwest-territories' => trans('general.northwest-territories'),
            'nova-scotia' => trans('general.nova-scotia'),
            'nunavut' => trans('general.nunavut'),
            'ontario' => trans('general.ontario'),
            'prince-edward-island' => trans('general.prince-edward-island'),
            'quebec' => trans('general.quebec'),
            'saskatchewan' => trans('general.saskatchewan'),
            'yukon' => trans('general.yukon')
        );
        
        asort($provinces);
        
        return view('users.address-book', compact('preferences', 'provinces', 'addresses'));
    }
    
    public function updateAddressBook(UpdateAddressBookRequest $request)
    {
        $input = $request->input();
        $user = Auth::user();
        
        if ($input['address_id'] == 'contact') {
            // Updater l'adresse de contact (preferences)
            unset($input['_token']);
            unset($input['address_id']);
            
            $user->mergePreferences($input);
            $user->save();
            
        } else if ($input['address_id'] == 'new') {
            // Créer une nouvelle adresse
            $address = new Address();
            $address->address = $input['address'];
            $address->city = $input['city'];
            $address->province = $input['province'];
            $address->postal_code = $input['postal_code'];
            $address->customer_id = $user->id;
            
            $customerAddressesCount = DB::table('addresses')->where('customer_id', $user->id)->count();
            
            $address->address_id = $customerAddressesCount; // Starting with zero
            $address->save();
        } else {
            // Updater l'adresse
            DB::table('addresses')
                ->where('customer_id', $user->id)
                ->where('address_id', $input['address_id'])
                ->update([
                    'address' => $input['address'],
                    'city' => $input['city'],
                    'province' => $input['province'],
                    'postal_code' => $input['postal_code']
                ]);
        }
        
        return array('redirect' => url('account/address-book') . '?message=' . trans('account.addressBookUpdated'));
    }
    
    public function preferences()
    {
        return view('users.preferences');
    }

    public function changePassword()
    {
        return view('users.change-password');
    }

    public function updatePassword(UpdatePassword $request)
    {
        $input = $request->input();
        $user = Auth::user();
        
        if (Hash::check($input['password'], $user->password)){
            if ($request->ajax()) {
                $user->password = Hash::make($input['new_password']);
                $user->save();
                
                return array('redirect' => url('/account/profile/') . '?message=' . trans('account.passwordUpdated'));
            }
            
        } else {
            return Response::json(['password' => trans('account.incorrectPassword')], 303);
        }
    }

}
