<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\PackageTables;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order =  Order::with(['products', 'package', 'client', 'reservation'])->where('is_done', 0)->paginate(40);
        return view('dashboard.order.index', compact('order'));
    }
    public function reservations()
    {
        $reservations = Reservation::where([['status', 'حجز'], ['payment_type', 'online']])->paginate(40);
        return view('dashboard.order.reservations', compact('reservations'));
    }
    public function editReservation($id)
    {
        $reservations = Reservation::where([['status', 'حجز'], ['payment_type', 'online']])->find($id);
        $packages = Package::where('branch_id', $reservations->package->branch_id)->get();

        return view('dashboard.order.edit', compact('reservations', 'packages'));
    }
    public function tableAvailable(Request $request)
    {
        $packageID = $request->id;
        $date = $request->date;
        $tables = PackageTables::where('package_id', $packageID)->get();
        $tables = Table::whereIn('id', $tables->pluck('id'))->whereDoesntHave('reservations', function ($query) use ($date) {
            $query->where('reservation_date', $date);
        })->get();
        return response()->json($tables);
    }
    public function finishOrders()
    {
        $order =  Order::with(['products', 'package', 'client', 'reservation'])->where('is_done', 1)->paginate(40);
        return view('dashboard.order.index', compact('order'));
    }


    public function show($id)
    {
        $order =  Order::with(['products', 'package', 'client', 'reservation'])->find($id);
        return view('dashboard.order.show', compact('order'));
    }
}
