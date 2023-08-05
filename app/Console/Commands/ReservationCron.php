<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReservationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDateTime = Carbon::now();


        $expiredReservations = Reservation::where('status', '!=', 'انتهى')->get();
        //  log::info($expiredReservations);
        // Update the status of the expired reservations
        foreach ($expiredReservations as $reservation) {
            $package = Package::find($reservation->package_id);
            $packageTimeInMinutes = $package->time; // Assuming the 'time' in the package is stored in minutes
            $formattedTime = Carbon::createFromFormat('g:i A', $reservation->time)->format('H:i');
            // Create a formatted datetime string for the reservation
            $reservationDateTime = $reservation->date;
            // Calculate the new end time by adding the package time to the reservation time
            $reservationEndTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservationDateTime)
                ->addMinutes($reservation->minutes);
            log::info($currentDateTime . '_' . $reservationEndTime);
            // Check if the new end time has passed
            if ($currentDateTime <= $reservationEndTime) {
                log::info($currentDateTime . '_' . $reservationEndTime . 't');
                // If the end time has passed, update the reservation status to 'انتهى' (or 'ended')
                $reservation->status = 'انتهى';
                $reservation->update();
                $table = Table::find($reservation->table_id);
                $table->status = 'available';
                $table->update();
                $order = Order::where([['table_id', $reservation->table_id], ['package_id', $reservation->package_id], ['is_done', 0]])->first();
                $order->is_done = 1;
                $order->update();
            } else {
                if ($reservation->status != 'تم الحضور') {
                    $reservation->status = 'تأخير';
                    $reservation->update();
                    $table = Table::find($reservation->table_id);
                    $table->status = 'late';
                    $table->update();
                }
            }
        }
    }
}
