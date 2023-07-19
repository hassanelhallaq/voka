<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $order = new OrderProduct();
        $order->product_id = $request->product_id;
        $order->table_id = $request->table_id;
        $order->package_id = $request->package_id;
        $order->quantity = $request->quantity;
        $order->price = $product->price;
        $order->save();
    }
}
