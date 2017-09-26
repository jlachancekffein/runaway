<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\Kit;
use App\Models\KitRequest;
use App\Models\Product;
use App\Models\Province;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\KitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class KitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Les kits en draft
        $kitDrafts = Kit::select(
                'kits.id as kit_id',
                'users.id as user_id',
                'users.name as user_name',
                'kit_requests.name as kit_request_name',
                'kit_requests.budget as kit_request_budget',
                'kit_requests.comment as kit_request_comment',
                'kit_requests.created_at as kit_request_created_at'
            )
            ->leftJoin('kit_requests', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'kits.customer_id');
            })
            ->where('kits.status', 'draft')
            ->get();

        // Les kitRequests qui n'ont pas encore de kits
        $kitRequests = KitRequest::select(
                'kit_requests.id as kit_request_id',
                'users.id as user_id',
                'users.name as user_name',
                'kit_requests.name as kit_request_name',
                'kit_requests.budget as kit_request_budget',
                'kit_requests.comment as kit_request_comment',
                'kit_requests.created_at as kit_request_created_at'
            )
            ->leftJoin('kits', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'kit_requests.customer_id');
            })
            ->where('kit_requests.status', 'pending')
            ->whereNull('kits.id')
            ->get();

        // Les kits payés
        $readyKits = Kit::select(
                'kits.id as kit_id',
                'users.id as user_id',
                'users.name as user_name',
                'kit_requests.name as kit_request_name',
                'kits.status as kit_status',
                'transactions.express_shipping as transaction_express_shipping'
            )
            ->leftJoin('transactions', function($join) {
                $join->on('transactions.kit_id', '=', 'kits.id');
            })
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'kits.customer_id');
            })
            ->leftJoin('kit_requests', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->where('transactions.status', 'paid')
            ->get();

        // Les kits pas encore payés
        $kits = Kit::select(
                'kits.id as kit_id',
                'users.id as user_id',
                'users.name as user_name',
                'kit_requests.name as kit_request_name',
                'kits.status as kit_status',
                'kits.expire_at as kit_expire_at'
            )
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'kits.customer_id');
            })
            ->leftJoin('kit_requests', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->where('kits.status', '<>', 'draft')
            ->where('kits.status', '<>', 'sold')
            ->get();

        // Les kits shippés
        $sentKits = Kit::select(
                'kits.id as kit_id',
                'users.id as user_id',
                'users.name as user_name',
                'kit_requests.name as kit_request_name',
                'transactions.status as transaction_status',
                'transactions.tracking_number as transaction_tracking_number',
                'transactions.express_shipping as transaction_express_shipping'
            )
            ->leftJoin('transactions', function($join) {
                $join->on('transactions.kit_id', '=', 'kits.id');
            })
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'kits.customer_id');
            })
            ->leftJoin('kit_requests', function($join) {
                $join->on('kit_requests.id', '=', 'kits.kit_request_id');
            })
            ->where('transactions.status', '<>', 'paid')
            ->get();

        return view('admin.kits.index', compact('kitRequests', 'kitDrafts', 'kits', 'readyKits', 'sentKits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actions = ['draft', 'pending'];

        return view('admin.kits.create', compact('actions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithCustomer($customerId)
    {
        $customer = User::find($customerId);
        $actions = ['draft', 'pending'];

        return view('admin.kits.create', compact('customer', 'actions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithKitRequest($kitRequestId)
    {
        $kitRequest = KitRequest::with('customer')->find($kitRequestId);
        $customer = $kitRequest->customer;
        $actions = ['draft', 'pending'];

        return view('admin.kits.create', compact('kitRequest', 'customer', 'actions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $kit = Kit::with(['customer', 'kitRequest'])->find($id);

        $products = $kit->products;
        $shippingAddress = null;
        $subtotal = null;
        $shipping = null;
        $taxes = null;
        $total = null;

        if ($kit->status == 'draft') {
            $actions = ['draft', 'pending'];

        } else if ($kit->status == 'sold') {
            $actions = ['sold'];

            $products = $kit->products->filter(function($key, $value){
                return $key->transaction_id;
            });

            $transaction = DB::table('transactions')->where('kit_id', $kit->id)->get();
            $transaction = $transaction[0];
            $transactionId = $transaction->id;
            $customerId = $kit->getCustomerId();
            $customer = User::find($customerId);

            if ($transaction->shipping_address == 'contact') {
                $preferences = (array) json_decode($customer->preferences);

                $shippingAddress = [
                    'address' => $preferences['address'],
                    'city' => $preferences['city'],
                    'province' => $preferences['province'],
                    'postal_code' => $preferences['postal_code'],
                ];

            } else {
                $shippingAddressFromBD = DB::table('addresses')
                    ->leftJoin('transactions', function($join) {
                        $join->on('transactions.customer_id', '=', 'addresses.customer_id');
                        $join->on('transactions.shipping_address', '=', 'addresses.address_id');
                    })
                    ->where('addresses.customer_id', $customerId)
                    ->where('transactions.id', $transactionId)
                    ->get();

                $shippingAddressFromBD = $shippingAddressFromBD[0];

                $shippingAddress = [
                    'address' => $shippingAddressFromBD->address,
                    'city' => $shippingAddressFromBD->city,
                    'province' => $shippingAddressFromBD->province,
                    'postal_code' => $shippingAddressFromBD->postal_code
                ];
            }
            
            foreach ($products as $product) {
                if ($product->reduced_price > 0) {
                    $subtotal += $product->reduced_price;
                } else {
                    $subtotal += $product->regular_price;
                }
            }
            
            $shipping = $transaction->express_shipping > 0 ? $transaction->express_shipping : config('ecommerce.shipping_cost');
            $shipping_province = $shippingAddress['province'];
            $provinces = Province::with('taxes')->get();
            
            foreach ($provinces as $province) {
                if ($province->key == $shipping_province) {
                    $taxes = $province->taxes->pluck('percentage', 'key')->filter();
                }
            }
            
            foreach ($taxes as $tax_name => $tax_value) {
                $taxes[$tax_name] = $tax_value * ($subtotal + $shipping);
            }
            
            $total = $subtotal + $shipping;
            
            foreach ($taxes as $tax) {
                $total += $tax;
            }

        } else {
            $actions = ['pending', 'seen', 'sold'];
        }
        
        return view('admin.kits.edit', compact('kit', 'actions', 'products', 'shippingAddress', 'subtotal', 'shipping', 'taxes', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kitRequestArray = $request->all();

        $validator = $this->validateKit($kitRequestArray);

        if ($validator->fails()) {
            $kit = KitRepository::insertDraft($kitRequestArray);
            return redirect('admin/kits/' . $kit->id)
                ->withErrors($validator)
                ->withInput();
        }

        $kit = KitRepository::insert($kitRequestArray);

        if ($kit->status == 'pending') {
            if (array_key_exists('kit_request_id', $kitRequestArray)) {
                $kitRequest = KitRequest::find($kitRequestArray['kit_request_id']);
                $kitRequest->status = 'answered';
                $kitRequest->save();
            }

            $this->sendNewKitEmail($kit->id);
        }

        return redirect('admin/kits');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kitRequestArray = $request->all();

        $validator = $this->validateKit($kitRequestArray, $id);

        if ($validator->fails()) {
            $kit = KitRepository::updateDraft($id, $kitRequestArray);
            return redirect('admin/kits/' . $kit->id)
                ->withErrors($validator)
                ->withInput();
        }

        KitRepository::update($id, $kitRequestArray);

        $kit = Kit::find($id);

        if ($kit->status == 'pending') {

            if (isset($kitRequestArray['kit_request_id'])) {
                $kitRequest = KitRequest::find($kitRequestArray['kit_request_id']);
                $kitRequest->status = 'answered';
                $kitRequest->save();
            }

            $this->sendNewKitEmail($id);
        }

        if ($kit->status == 'sold') {
            $transactions = Transaction::select('transactions.*')->where('kit_id', $id)->get();

            foreach ($transactions as $transaction) {
                if (array_key_exists('tracking', $kitRequestArray) && $kitRequestArray['tracking'] != '') {
                    $transaction->tracking_number = $kitRequestArray['tracking'];
                }

                $transaction->status = 'sent';
                $transaction->save();
            }
        }

        return redirect('admin/kits');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateKit(array $data, $id = null)
    {
        $validations = [
            'product' => 'required',
            'product.marker_x.*' => 'required',
            'product.marker_y.*' => 'required',
            'product.brand.*' => 'required',
            'product.name.*' => 'required',
            'product.regular_price.*' => 'required',
            // 'product.reduced_price.*' => 'required',
            'status' => 'required|in:draft,pending,seen,sold',
            'photo' => 'required|image',
        ];

        if ($id && KitRepository::hasPhoto($id)) {
            unset($validations['photo']);
        }

        return Validator::make($data, $validations);
    }

    private function sendNewKitEmail($kitId) {
        $kit = Kit::find($kitId);

        $customerId = $kit->getCustomerId();
        $customer = User::find($customerId);

        $data = array(
            'link' => url('/account/kits/' . $kit->id),
            'userName' => $customer->name
        );

        isolate_callback_with_language($customer->language, function () use ($data, $customer) {
            Mail::send(['emails.kit', 'emails.kit-plain'], $data, function ($m) use ($customer) {
                $m->to($customer->email, $customer->name)->subject(trans('kits.emailSubject'));
            });
        });
    }

    public function deleteKit($kitId)
    {
        $kit = DB::table('kits')
            ->select('kits.*', 'transactions.id as transaction_id')
            ->leftJoin('transactions', function($join) {
                $join->on('transactions.kit_id', '=', 'kits.id');
            })
            ->where('kits.id', $kitId)
            ->get();

        $kit = $kit[0];
        $customerId = $kit->customer_id;
        
        // Si le kit a été payé, ne rien supprimer/modifier
        if (!empty($kit->transaction_id)) {
            return redirect('/admin/kits/?message=' . trans('kits.cannotDeletePaidKit'));
        }
        
        
        
        $kitRequest = DB::table('kit_requests')
            ->select('kit_requests.*')
            ->leftJoin('kits', function($join) {
                $join->on('kits.kit_request_id', '=', 'kit_requests.id');
            })
            ->where('kits.id', $kitId)
            ->get();
        
        if (!empty($kitRequest)) {
            $kitRequest = $kitRequest[0];
            $kitName = $kitRequest->name;
            
            // Informer le customer
            if ($kit->status !== 'draft') {
                $customer = User::find($customerId);
                $data = compact('kitName');

                isolate_callback_with_language($customer->language, function () use ($data, $customer) {
                    Mail::send(['emails.kitDeleted', 'emails.kitDeleted-plain'], $data, function ($m) use ($customer) {
                        $m->to($customer->email, $customer->name)->subject(trans('kits.kitDeletedEmailSubject'));
                    });
                });
            }
        }



        
        // Supprimer le kitRequest
        KitRequest::whereHas('kit', function ($query) use ($kitId) {
            $query->where('id', $kitId);
        })
        ->delete();

        // Supprimer le kit
        Kit::where('id', $kitId)
            ->delete();

        // Supprimer les produits associés au kit
        Product::where('kit_id', $kitId)
            ->delete();

        return redirect('/admin/kits/?message=' . trans('kits.kitDeleted'));
    }
}
