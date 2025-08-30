<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // ✅ make sure Order model exist
use App\Models\OrderItem;
use App\Notifications\OrderStatusUpdated;



class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        $orders = Order::all(); // fetch all orders
        return view('admin.orders.index', compact('orders'));
    }

    // Update order status
  public function updateStatus(Request $request, $orderId)
{
    $order = Order::find($orderId);
    if (!$order) {
        return redirect()->back()->with('error', 'Order not found!');
    }

    $request->validate([
        'status' => 'required|in:Pending,Shipped,Delivered',
    ]);

    // Update status
    $order->status = trim($request->status);
    $order->save();

    // ✅ Send notification to customer
    $order->customer->notify(new OrderStatusUpdated($order));

    return redirect()->back()->with('success', 'Order status updated and customer notified!');
}


}
