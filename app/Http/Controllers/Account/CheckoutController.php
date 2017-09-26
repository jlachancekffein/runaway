<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Kit;
use App\Models\KitRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    
    public function payment()
    {
        $kit = Kit::with(['kitRequest', 'customer', 'products' => function ($query) {
            $query->whereIn('id', session('cart')['products']);
        }])->find(session('cart')['kitId']);
        
        
        return view('checkout.payment', compact('kit'));
    }

    public function charge(Request $request)
    {
        $stripeToken = $request->input('stripeToken');
        
        $charge = Stripe::charges()->create([
            'currency' => 'CAD',
            'amount'   => str_replace(',', '.', (string) session('cart.total')),
            'source' => $stripeToken
        ]);

        $taxes = array_values(session('cart.taxes'));

        $transaction = new Transaction();
        $transaction->customer_id = Auth::user()->id;
        $transaction->kit_id = session('cart.kitId');
        $transaction->subtotal = session('cart.subtotal');
        $transaction->express_shipping = session('cart.express_shipping');

        $i = 0;

        foreach (session('cart.taxes') as $taxKey => $taxValue) {
            $transactionKey = "tax$i";
            $transaction->$transactionKey = $taxValue;

            if (++$i === 2) {
                break;
            }
        }

        $transaction->total = session('cart.total');
        $transaction->shipping_address = session('cart.shipping_address');
        $transaction->billing_address = session('cart.billing_address');
        $transaction->stripe_transaction_id = $charge['id'];
        $transaction->status = 'paid';
        $transaction->save();
        
        $kit = Kit::find(session('cart.kitId'));
        $kit->status = 'sold';
        $kit->save();
        
        $transactionDate = $transaction->created_at;
        $transactionId = $transaction->stripe_transaction_id;
        
        $customer = User::find(Auth::user()->id);
        $customerName = $customer->name;
        
        $kitRequest = KitRequest::find($kit->kit_request_id);
        
        if (!empty($kitRequest)) {
            $kitName = $kitRequest->name;
        } else {
            $kitName = trans('kits.genericKitName');
        }

        $subtotal = session('cart.subtotal');
        $expressShipping = session('cart.express_shipping');
        $taxes = session('cart.taxes');
        $total = session('cart.total');
        
        $products_ids = session('cart.products'); // Se sont seulement les ids
        $products = array();
        
        foreach ($products_ids as $product_id) {
            $product = Product::find($product_id);
            $product->transaction_id = $transactionId;
            $product->save();
            
            $products[$product_id] = array(
                'name' => $product->name,
                'regular_price' => $product->regular_price,
                'reduced_price' => $product->reduced_price,
                'brand' => $product->brand
            );
        }
        
        $data = compact('customerName', 'kitName', 'transactionDate', 'transactionId', 'subtotal', 'expressShipping', 'taxes', 'total', 'products');
        
        Mail::send(['emails.receipt', 'emails.receipt-plain'], $data, function ($m) use ($customer) {
            $m->to($customer->email, $customer->name)->subject(trans('cart.emailSubject'));
        });
        
        $link = url('/admin/kits/' . $kit->id);
        
        $data = compact('customerName', 'kitName', 'transactionDate', 'transactionId', 'link');
        
        Mail::send(['emails.kitConfirmed', 'emails.kitConfirmed-plain'], $data, function ($m) use ($customerName) {
            $m->to(trans('general.r2dEmail'), 'Runway 2 Doorway')->subject(trans('kits.emailConfirmedSubject', ['customerName' => $customerName]));
        });
        
        return redirect('/account/checkout/success');
    }

    public function success()
    {
        session(['cart' => null]);

        return view('checkout.success');
    }

}
