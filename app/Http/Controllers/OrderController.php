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
        $reservations = Reservation::where([['status', '!=', 'انتهى'], ['back_price', '!=', 0]])->paginate(40);
        return view('dashboard.order.reservations', compact('reservations'));
    }
    public function reservationsRefund()
    {
        $reservations = Reservation::where('back_price', '!=', 0)->paginate(40);
        return view('dashboard.order.reservations', compact('reservations'));
    }
    public function editReservation($id)
    {
        $reservation = Reservation::where([['status', 'حجز'], ['payment_type', 'online']])->find($id);
        $packages = Package::where('branch_id', $reservation->package->branch_id)->get();

        return view('dashboard.order.edit', compact('reservation', 'packages'));
    }
    public function updateReservation(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'price' => 'required',
            'package_id' => 'required',
            'table_id' => 'required',
            'minutes' => 'required',
        ]);
        $reservation = Reservation::find($id);
        $reservation->date = $request->date;
        $reservation->price = $request->price;
        $reservation->package_id = $request->package_id;
        $reservation->table_id = $request->table_id;
        $reservation->minutes = $request->minutes;
        $reservation->update();
        return redirect()->route('reservations.all')->with('success', 'Reservation created successfully');
    }
    public function backReservation(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->price = 0;
        $reservation->status = 'انتهى';
        $reservation->back_price = $reservation->price;
        $reservation->update();
        return redirect()->route('reservations.all')->with('success', 'Reservation created successfully');
    }
    public function tableAvailable(Request $request)
    {
        $packageID = $request->id;
        $date = $request->date;
        $tables = PackageTables::where('package_id', $packageID)->get();
        $tables = Table::whereIn('id', $tables->pluck('id'))->whereDoesntHave('reservations', function ($query) use ($date) {
            $query->where('date', $date);
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
