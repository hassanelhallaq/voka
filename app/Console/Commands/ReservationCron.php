<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Console\Command;

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


        $expiredReservations = Reservation::where(function ($query) use ($currentDateTime) {
            // Combine 'reservation_date' and 'time' columns and compare with the current date and time
            $query->whereDate('date', '<', $currentDateTime->toDateString())
                ->orWhere(function ($query) use ($currentDateTime) {
                    $query->whereDate('date', '=', $currentDateTime->toDateString())
                        ->whereTime('time', '<', $currentDateTime->toTimeString());
                });
        })->where('status', '!=', 'انتهى')->get();

        // Update the status of the expired reservations
        foreach ($expiredReservations as $reservation) {
            $package = Package::find($reservation->package_id);
            $packageTimeInMinutes = $package->time; // Assuming the 'time' in the package is stored in minutes
            $formattedTime = Carbon::createFromFormat('g:i A', $reservation->time)->format('H:i');
            // Create a formatted datetime string for the reservation
            $reservationDateTime = $reservation->date . ' ' . $formattedTime . ':00';

            // Calculate the new end time by adding the package time to the reservation time
            $reservationEndTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservationDateTime)
                ->addMinutes($packageTimeInMinutes);

            // Check if the new end time has passed
            if ($currentDateTime >= $reservationEndTime) {
                // If the end time has passed, update the reservation status to 'انتهى' (or 'ended')
                $reservation->status = 'انتهى';
                $reservation->update();
                $table = Table::find($reservation->table_id);
                $table->status = 'available';
                $table->update();
                $order = Order::where([['table_id', $reservation->table_id], ['package_id', $reservation->package_id], ['is_done', 0]])->first();
                $order->is_done = 1;
                $order->update();
            }
        }
    }
}
