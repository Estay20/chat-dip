<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\OrderCreate;



class OrderController extends Controller
{

    public function __construct(Request $request)
    {
        view()->composer('crm.layouts.link', function($view){
            $view->with(['active_name' => 'orders']);
        });
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('crm.orders.index', ['orders' => Order::with(['products' => function ($query){
                $query->select('products.id', 'products.name', 'products.cost', 'product_id', 'order_id','order_products.count as order_count', 'products.count');
            }])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.orders.create', ['products' => Product::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderCreate $request)
    {
        $order = Order::create([
            'customer' => $request->input('customer'),
            'telephone' => $request->input('telephone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'status_id' => 1
        ]);
        foreach ($request->input('product') as $product) {
            $order->products()->attach($product['product_id'], ['count' => $product['count']]);
        }
        return response()->redirectTo('/order');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
