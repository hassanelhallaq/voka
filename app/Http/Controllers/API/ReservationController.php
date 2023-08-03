<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lounge;
use Illuminate\Http\Request;
use App\Models\Table;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
z
        // Define the time slots in 24-hour format
        $timeSlots = ["06:00", "08:00", "10:00", "12:00", "14:00", "16:00", "18:00", "20:00", "22:00", "00:00"];

        // Fetch all tables with their reservations
        $currentDate = Carbon::now()->toDateString();

        // Fetch all tables with their reservations for today
        $lounges = Lounge::where('branch_id', $request->branch_id)->with(['tables' => function ($q) use ($currentDate) {
            $q->with(['reservations' => function ($query) use ($currentDate) {
                $query->whereDate('date', $currentDate);
            }]);
        }])->get();
        // Prepare the result array
        $avaTables = [
            'hours' => $timeSlots,
            'tables' => [],
        ];

        // Iterate through each table and build the availability array
        foreach ($timeSlots as $slot) {
            $avaTables['hours'][] = date('h:i A', strtotime($slot));
        }

        // Loop through each lounge
        foreach ($lounges as $lounge) {
            $tablesData = [];

            // Loop through each table in the lounge
            foreach ($lounge->tables as $table) {
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
                    $availability[] = $isAvailable;
                }

                // Add the table information to the tablesData array
                $tablesData[] = [
                    'id' => $table->id,
                    'name' => $table->name,
                    'availability' => $availability,
                ];
            }

            // Add the lounge information with tablesData to the result array
            $avaTables['salons'][] = [
                'name' => $lounge->name,
                'tables' => $tablesData,
            ];
        }

        // Convert the array to JSON
        return $avaTables;

        // Now $avaTablesJson contains the desired JSON format with 24-hour time slots

    }
}
