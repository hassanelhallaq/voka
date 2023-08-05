<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\Wallet;
use App\Models\WalletAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReservationController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'table_id' => 'required|exists:tables,id',
            'client_id' => 'required|exists:clients,id',
            'payment' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $dateString = $request->date;
            $date = Carbon::createFromFormat('j F - Y', $dateString);
            $formattedDate = $date->format('Y-m-d');
            $package = Package::find($request->package_id);
            $wallet = Wallet::where('client_id', $request->client_id)->first();
            $price = $package->price * .15;
            if (!$wallet && $request->payment == 'المحفظة') {
                return response()->json(['icon' => 'error', 'title' => 'رصيد محفظتك لا يكفي'], 400);
            }
            if ($request->payment == 'المحفظة' && $wallet->credit > $price) {
                return response()->json(['icon' => 'error', 'title' => 'رصيد محفظتك لا يكفي'], 400);
            }
            $timeRange = $request->time;

            // Split the time range string into start and end time strings
            list($startTimeString, $endTimeString) = explode(" - ", $timeRange);

            // Convert start and end time strings to DateTime objects using Carbon
            $startDateTime = Carbon::createFromFormat('g:i A', trim($startTimeString));
            $endDateTime = Carbon::createFromFormat('g:i A', trim($endTimeString));

            // If you need to work with dates, you can set the date part as well
            $startDate = Carbon::today(); // Assuming the current date, you can use any date here
            $startDateTime->setDate($startDate->year, $startDate->month, $startDate->day);

            $endDate = $startDate->copy(); // Clone the start date to get the end date
            $endDateTime->setDate($endDate->year, $endDate->month, $endDate->day);

            // Now you have start and end DateTime objects with date and time information
            $reservation = new Reservation();
            $reservation->package_id = $request->package_id;
            $reservation->price = $price;
            $reservation->minutes = $package->time;
            $reservation->table_id = $request->table_id;
            $reservation->client_id = $request->client_id;
            $reservation->time =  $startDateTime;
            $reservation->date = $startDateTime->format('Y-m-d H:i:s');
            $reservation->end = $endDateTime->format('Y-m-d H:i:s');
            $reservation->time_end = $endDateTime;
            $reservation->note = $request->note;
            $reservation->status = 'مؤكد';
            $reservation->payment_type = $request->payment;
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
            if ($request->payment == 'المحفظة' && $wallet->credit > $price) {
                $wallet->credit = $wallet->credit - $price;
                $wallet->update();
                $walletAction = new WalletAction();
                $walletAction->action_tite = $price . 'لقد تم خصم من رصيد نقاطك مبلغ';
                $walletAction->amount = $price;
                $walletAction->balance_before = $wallet->credit + $price;
                $walletAction->status = 'Success';
                $walletAction->wallet_id  = $wallet->id;
                $walletAction->action_type   = 'App\Models\Client';
                $walletAction->action_id    = $request->client_id;
                $walletAction->type   = 'Discount';
                $walletAction->save();
            }
            return ['redirect' => route('branch.home')];
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
}
