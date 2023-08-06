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
        if ($order) {
        $totalOrderPrices = $order->products->sum(function ($product) {
        return $product->price * $product->quantity;
         });
        }else{
            $totalOrderPrices =0;
        }
        
         
        $packagePrice = $order->table->reservation->where('status', '!=', 'انتهى')->first()->price;
        if ($packagePrice < $totalOrderPrices) {
            return response()->json(['icon' => 'error', 'title' => 'لقد استهلكت رصيد باقتك'], 400);
        }
        $orderProduct = new OrderProduct();
        $orderProduct->product_id = $request->product_id;
        $orderProduct->order_id = $order->id;
        $orderProduct->quantity = $request->quantity;
        $orderProduct->price = $product->price;
        $orderProduct->save();
    }
}
