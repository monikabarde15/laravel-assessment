<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;


class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
    'items' => 'required|array|min:1',               // ensure array has at least 1 item
    'items.*.product_id' => 'required|exists:products,id',
    'items.*.qty'        => 'required|integer|min:1',
]);


        foreach ($request->items as $item) {
            $order = Order::create([
                'customer_id' => auth('customer')->id(),
                'status'      => 'pending',
            ]);

            OrderItem::create([
    'order_id'    => $order->id,
    'product_id'  => $item['product_id'],
    'qty'         => $item['qty'],
    'price'       => 0
]);

        }

        return redirect()->back()->with('success', 'Order placed successfully!');
    }


    public function index()
    {
$orders = Order::where('customer_id', auth('customer')->id())
               ->with('items.product') // nested relation
               ->get();
                       return view('customer.orders.index', compact('orders'));
    }
}
