<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Kit;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitsController extends Controller
{

    const BUYABLE_ITEM_QUANTITY = 5;
    
    public function index()
    {
        $kits = Kit::where('customer_id', Auth::user()->id)
            ->with('kitRequest')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.kits.index', compact('kits'));
    }

    public function show($kitId)
    {
        $user = Auth::user();

        $kit = Kit::with(['kitRequest', 'products'])->find($kitId);

        if ($kit->status == 'draft') {
            return redirect('account/profile/');
        }

        if ($kit->customer_id != $user->id) {
            return redirect('account/profile/');
        }
        
        if ($kit->status == 'pending') {
            $kit->status = 'seen';
            $kit->save();
        }
        
        $provinces = Province::with('taxes')->get();

        $products = $kit->unsoldProducts();
        $subtotal = $products->sum();

        $preferences = (array) json_decode($user->preferences, true);

        $addresses = Address::where('customer_id', $user->id)->get();
        $addresses->push((object) [
            'address_id' => 'contact',
            'address' => $preferences['address'],
            'city' => $preferences['city'],
            'province' => $preferences['province'],
            'postal_code' => $preferences['postal_code']
        ]);

        return view('account.kits.show', compact('kit', 'provinces', 'subtotal', 'products', 'addresses'));
    }

    public function storeCart(Request $request, $kitId)
    {
        $userAddresses = Auth::user()->addresses->push($this->getUserPreferencesAddress());
        $this->validateAddresses($userAddresses);

        $productIds = collect($request->input('product'))->filter()->keys();

        if (count($productIds) > self::BUYABLE_ITEM_QUANTITY) {
            return redirect('account/kits/' . $kitId)
                ->withErrors(trans_choice('kits.productLimit', self::BUYABLE_ITEM_QUANTITY, [
                    'quantity' => self::BUYABLE_ITEM_QUANTITY
                ]))
                ->withInput();
        }

        if ($productIds->count() === 0) {
            return redirect('account/kits/' . $kitId)
                ->withErrors(trans('kits.productRequired'))
                ->withInput();
        }

        $products = Product::whereIn('id', $productIds->all())->get();
        $products->setExpressShipping(request('express_shipping'));

        $shippingAddress = $this->getAddress($userAddresses, 'shipping');
        $shippingProvince = Province::where('key', $this->getShippingProvinceKey($request, $userAddresses))->first();
        $billingAddress = $this->getAddress($userAddresses, 'billing');

        session([
            'cart' => [
                'kitId' => $kitId,
                'products' => $productIds->all(),
                'subtotal' => $products->getSubtotal(),
                'express_shipping' => $products->getExpressShipping(),
                'taxes' => $products->getTaxes($shippingProvince)->all(),
                'total' => $products->getTotal($shippingProvince),
                'shipping_address' => $shippingAddress->address_id,
                'billing_address' => $billingAddress->address_id,
            ]
        ]);

        return redirect('/account/checkout/payment');
    }

    private function getShippingProvinceKey(Request $request, $userAddresses)
    {
        if ($request->input('shipping_address') === 'contact') {
            return json_decode(Auth::user()->preferences, true)['province'];
        }
        return $userAddresses->whereLoose('address_id', (int)$request->input('shipping_address'))->first()->province;
    }

    private function validateAddresses($userAddresses)
    {
        $addressesValidation = trim('contact,' . $userAddresses->implode('address_id', ','));
        $this->validate(request(), [
            'shipping_address' => 'required|in:' . $addressesValidation,
            'billing_address' => 'required|in:' . $addressesValidation
        ]);
    }

    private function getUserPreferencesAddress()
    {
        $userPreferences = json_decode(Auth::user()->preferences);
        return new Address([
            'address_id' => 'contact',
            'customer_id' => Auth::user()->id,
            'address' => $userPreferences->address,
            'city' => $userPreferences->city,
            'province' => $userPreferences->province,
            'postal_code' => $userPreferences->postal_code,
        ]);
    }

    private function getAddress($userAddresses, $type)
    {
        if (request("{$type}_address") === 'contact') {
            return $userAddresses->whereLoose('address_id', (string) request("{$type}_address"))->first();
        }
        return $userAddresses->whereLoose('address_id', (int) request("{$type}_address"))->first();
    }

}
