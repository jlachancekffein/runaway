<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Transaction;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Transaction::all();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $brands = DB::table('order_products')->distinct('name')->get();

        return view('admin.orders.create', compact('brands'));
    }

    public function store(OrderRequest $request)
    {
        Transaction::create($request->all());
        session()->flash('status', 'Nouvelle commande créée');

        return redirect('/admin/orders');
    }

    public function edit($id)
    {
        $order = Transaction::find($id);
        $brands = DB::table('order_products')->distinct('name')->get();

        return view('admin.orders.edit', compact('order', 'brands'));
    }

    public function update(OrderRequest $request, $id)
    {
        Transaction::where($id)->update($request->all());
        session()->flash('status', 'Commande sauvegardée');

        return redirect('/admin/orders');
    }

    public function destroy($id)
    {
        $order = Transaction::find($id);

        if ($order->status === 'sent') {
            session()->flash('status', 'Impossible de supprimer cette commande');
            return back();
        }

        session()->flash('status', 'Commande supprimée');
        Transaction::destroy($id);

        $user = Auth::user();
        logger("User #$user->id deleted order #$id");

        return back();
    }

}
