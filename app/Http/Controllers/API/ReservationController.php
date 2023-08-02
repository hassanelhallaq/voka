<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {

        // Define the time slots in 24-hour format
        $timeSlots = ["06:00", "09:00", "12:00", "15:00", "18:00", "21:00", "00:00", "03:00"];

        // Fetch all tables with their reservations
           $currentDate = Carbon::now()->toDateString();

        // Fetch all tables with their reservations for today
         $tables = Table::with(['reservations' => function ($query) use ($currentDate) {
            // Filter reservations for today
            $query->whereDate('date', $currentDate);
        }])->get();
        // Prepare the result array
        $avaTables = [
            'hours' => $timeSlots,
            'tables' => [],
        ];

        // Iterate through each table and build the availability array
        foreach ($tables as $table) {
            $availability = [];

            // Fill the availability array with true (1) for available slots and false (0) for booked slots
            foreach ($timeSlots as $slot) {
                $isAvailable = true;

                // Check if the table is booked for the current time slot
                foreach ($table->reservations as $reservation) {
                    $reservationStart = date('H:i', strtotime($reservation->date));
                      $reservationEnd = date('H:i', strtotime($reservation->end));

                    if ($reservationStart <= $slot && $reservationEnd > $slot) {
                        $isAvailable = false;
                        break;
                    }
                }

                $availability[] = $isAvailable ? 1 : 0;
            }

            // Add the table information to the result array
            $avaTables['tables'][] = [
                'id' => $table->id,
                'name' => $table->name,
                'availability' => $availability,
            ];
        }

        // Convert the array to JSON
        return $avaTables;

        // Now $avaTablesJson contains the desired JSON format with 24-hour time slots

    }
}
