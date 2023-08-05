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
            $package = Package::find($request->package_id);
            $wallet = Wallet::where('client_id', $request->client_id)->first();
            $price = $package->price * .15;
            if (!$wallet && $request->payment == 'المحفظة') {
                return response()->json(['icon' => 'error', 'title' => 'رصيد محفظتك لا يكفي'], 400);
            }
            if ($request->payment == 'المحفظة' && $wallet->credit > $price) {
                return response()->json(['icon' => 'error', 'title' => 'رصيد محفظتك لا يكفي'], 400);
            }
            $timeString = $request->time;

            // Split the string into start and end time parts
            $timeParts = explode("-", $timeString);

            // Extract the start and end time strings and trim any leading or trailing whitespaces
            $startTime = trim($timeParts[0]);
            $endTime = trim($timeParts[1]);

            // Get the current date
            $currentDate = Carbon::today();

            // Convert the time strings to DateTime objects
            $startDate = $currentDate->copy()->setTimeFromTimeString($startTime);
            $endDate = $currentDate->copy()->setTimeFromTimeString($endTime);

            // Format the date objects to display in the desired format
            $formattedStartTime = $startDate->format('g:i A'); // Output: 4:16 PM
            $formattedEndTime = $endDate->format('g:i A');     // Output: 5:17 PM

            // Optionally, you can also get the full datetime in a specific format:
            $formattedStartDatetime = $startDate->format('Y-m-d H:i:s'); // Output: e.g., 2023-08-05 16:16:00
            $formattedEndDatetime = $endDate->format('Y-m-d H:i:s');  // Output: e.g., 2023-08-05 17:17:00

            // Now you can use the formatted start and end time values as needed

            // Now you have start and end DateTime objects with date and time information
            $reservation = new Reservation();
            $reservation->package_id = $request->package_id;
            $reservation->price = $price;
            $reservation->minutes = $package->time;
            $reservation->table_id = $request->table_id;
            $reservation->client_id = $request->client_id;
            $reservation->time =  $formattedStartTime;
            $reservation->date = $formattedStartDatetime;
            $reservation->end = $formattedEndDatetime;
            $reservation->time_end = $formattedEndTime;
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
