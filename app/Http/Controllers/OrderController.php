<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order =  Order::with(['products', 'package', 'client'])->where('is_done', 0)->paginate(40);
        return view('dashboard.order.index', compact('order'));
    }

    public function finishOrders()
    {
        $order =  Order::with(['products', 'package', 'client'])->where('is_done', 1)->paginate(40);
        return view('dashboard.order.index', compact('order'));
    }


    public function show($id)
    {
        $order =  Order::with(['products', 'package', 'client', 'reservation'])->find($id);
        return view('dashboard.order.show', compact('order'));
    }
}
