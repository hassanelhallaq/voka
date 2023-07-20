<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{


    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $order = Order::where([['table_id', $request->table_id], ['package_id', $request->package_id], ['is_done', 0]])->first();
        $orderProduct = new OrderProduct();
        $orderProduct->product_id = $request->product_id;
        $orderProduct->order_id = $order->id;
        $orderProduct->quantity = $request->quantity;
        $orderProduct->price = $product->price;
        $orderProduct->save();
    }
}
