<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $q = Product::query();
        if ($term = $request->get('q')) {
            $q->where('name','like',"%{$term}%");
        }
        $products = $q->paginate(10);

        return view('customer.shop.index', compact('products'));
    }
    public function show($id)
    {
        $product = \App\Models\Product::with('category')->findOrFail($id);
        return view('customer.shop.show', compact('product'));
    }
}
