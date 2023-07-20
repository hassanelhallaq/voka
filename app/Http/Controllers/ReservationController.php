<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $dateString = $request->date;
        $date = Carbon::createFromFormat('j F - Y', $dateString);
        $formattedDate = $date->format('Y-m-d');
        $reservation = new Reservation();
        $reservation->package_id = $request->package_id;
        $reservation->table_id = $request->table_id;
        $reservation->client_id = $request->client_id;
        $reservation->date = $formattedDate;
        $reservation->time = $request->time;
        $reservation->note = $request->note;
        $reservation->status = $request->status;
        $isSaved = $reservation->save();
        $table = Table::find($request->table_id);
        $table->status = 'in_service';
        $table->save();
        $order = new Order();
        $order->table_id = $request->table_id;
        $order->package_id = $request->package_id;
        $order->client_id = $request->client_id;
        $order->is_done = 0;
        $order->save();
        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }
}
