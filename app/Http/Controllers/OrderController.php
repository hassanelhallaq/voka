<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order =  Order::with(['products', 'package', 'client'])->paginate(40);
        return view('dashboard.order.index', compact('order'));
    }
}
