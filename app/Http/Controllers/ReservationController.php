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
            'date' => 'required',
            'package_id' => 'required|exists:packages,id',
            'table_id' => 'required|exists:tables,id',
            'client_id' => 'required|exists:clients,id',
            'payment' => 'required|string',
            'status' => 'required',
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
            $formattedTimeFrom = Carbon::createFromFormat('g:i A', $request->time);
            $combinedDateTimeString = $formattedDate . ' ' . $formattedTimeFrom;
            $dateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $combinedDateTimeString);
            $formattedTime = Carbon::createFromFormat('g:i A', $request->time)->addMinutes($package->time)->format('H:i');
            $combinedDateTimeStringEnd = $formattedDate . ' ' . $formattedTime;
            $reservation = new Reservation();
            $reservation->package_id = $request->package_id;
            $reservation->price = $price;
            $reservation->minutes = $package->time;
            $reservation->table_id = $request->table_id;
            $reservation->client_id = $request->client_id;
            $reservation->time = $request->time;
            $reservation->date = $dateTime;
            $reservation->end = $combinedDateTimeStringEnd;
            $reservation->time_end = $formattedTime;
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
