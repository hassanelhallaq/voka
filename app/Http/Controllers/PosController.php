<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lounge;
use App\Models\OrderProduct;
use App\Models\Package;
use App\Models\ProductCategory;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function home()
    {
        $halles = Lounge::with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $now = Carbon::now(); // Get the current date and time
                $q->with(['package' => function ($q) use ($now) {
                    $q->select('id', 'time', 'name', 'price'); // Select the necessary columns from the package table
                }])
                    ->where('status', '!=', 'انتهى');
            }]);
        }])->where('branch_id', Auth::user()->branch_id)->get();

        return response()->view('branch.home', compact('halles'));
    }

    public function _hallesBranch(Request $request)
    {
        $halles = Lounge::where('branch_id', Auth::user()->branch_id)->with(['tables' => function ($query) use ($request) {
            $query->whereHas('packages', function ($q) use ($request) {
                $q->where('package_id', $request->id);
            });
        }])->whereHas('tables', function ($query) use ($request) {
            $query->with('packages')->whereHas('packages', function ($q) use ($request) {
                $q->where('package_id', $request->id);
            });
        })->get();
        return view('branch._halles_branch', compact('halles'))->render();
    }
    public function _home()
    {
        $halles = Lounge::with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $now = Carbon::now(); // Get the current date and time
                $q->with(['package' => function ($q) use ($now) {
                    $q->select('id', 'time', 'name', 'price'); // Select the necessary columns from the package table
                }])
                    ->where('status', '!=', 'انتهى');
            }]);
        }])->where('branch_id', Auth::user()->branch_id)->get();
        return view('branch._home', compact('halles'))->render();
    }

    public function products()
    {
        $products = ProductCategory::with(['Product' => function ($query) {
            $query->whereHas('branches', function ($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            });
        }])->whereHas('Product', function ($q) {
            $q->whereHas('branches', function ($q) {
                $q->where('branch_id', Auth::user()->branch_id);
            });
        })->get();
        return  $render = view('branch.products', compact('products'));
    }

    public function halls()
    {
        $halles = Lounge::with('tables')->where('branch_id', Auth::user()->branch_id)->get();
        return  $render = view('branch._halls', compact('halles'));
    }

    public function _client(Request $request)
    {
        $clients = Client::when($request->phone, function ($query) use ($request) {
            $query->where('phone', $request->phone);
        })->paginate(10);
        return  $render = view('branch._clients', compact('clients'));
    }

    public function packages()
    {
        $dayOfWeek = Carbon::now()->format('l');
        $time = Carbon::now()->format('H:i:s');
        $packages = Package::where('branch_id', Auth::user()->branch_id)
            ->whereHas('schedules', function ($query) use ($dayOfWeek, $time) {
                $query->where('day_of_week', strtolower($dayOfWeek)) // Convert to lowercase for case-insensitive comparison
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>=', $time);
            })
            ->get();
        return response()->view('branch.packages', compact('packages'));
    }
    public function resver(Request $request)
    {
        $date = \Carbon\Carbon::now();
        $lastMonth =  $date->subMonth();
        $data = Reservation::whereBetween('date', [Carbon::now()->subMonth(2), Carbon::now()->addMonth(6)])
            ->get();

        $data = Reservation::get();
        $newData = [];

            foreach ($data as $index => $item) {
                $formattedTime = Carbon::createFromFormat('g:i A', $item->time)->format('H:i');
                $reservationDateTime = $item->date . ' ' . $formattedTime . ':00';
                $date =  $item->date . ' ' . $formattedTime;
                $color = '#48cfcf';
                $newData[$index]['id']        = $item->id;
                $str = explode(' ', $item->package->name);
                $client_name = $str[0];
                $newData[$index]['title']     = "\n" . $item->package->name . "\n";
                $newData[$index]['start']     = $reservationDateTime;
                $newData[$index]['color']       = $color;
            }
            return response()->json([
                view('branch.reserv')->with($newData)->render()
            ]);
          
       
    }
    public function ajaxCalender(Request $request)
    {
        $data = Reservation::whereDate('date', '>=', $request->start)
            ->get();
        $newData = [];
        foreach ($data as $index => $item) {
            $formattedTime = Carbon::createFromFormat('g:i A', $item->time)->format('H:i');
            $reservationDateTime = $item->date . ' ' . $formattedTime . ':00';
            $date =  $item->date . ' ' . $formattedTime;
            $color = '#48cfcf';
            $newData[$index]['id']        = $item->id;
            $str = explode(' ', $item->package->name);
            $client_name = $str[0];
            $newData[$index]['title']     = "\n" . $item->package->name . "\n";
            $newData[$index]['start']     = $reservationDateTime;
            $newData[$index]['color']       = $color;
        }

        return response()->json($newData);
    }
    public function sideReser(Request $request)
    {

        $reservation = Reservation::find($request->id);

        return  $render = view('branch.reservSide', compact('reservation'));
    }

    public function productOrder($id)
    {
        $products = ProductCategory::with(['Product' => function ($query) {
            $query->whereHas('branches', function ($query) {
                $query->where('branch_id', Auth::user()->branch_id);
            });
        }])->whereHas('Product', function ($q) {
            $q->whereHas('branches', function ($q) {
                $q->where('branch_id', Auth::user()->branch_id);
            });
        })->get();
        $table = Table::with(['reservation' => function ($q) {
            $q->where('status', 'مؤكد');
        }])->find($id);
        return  $render = view('branch.products_orders', compact('products', 'table'));
    }
    public function reservation()
    {
        $dayOfWeek = Carbon::now()->format('l');
        $time = Carbon::now()->format('H:i:s');
        $packages = Package::where('branch_id', Auth::user()->branch_id)

            // ->whereHas('schedules', function ($query) use ($dayOfWeek, $time) {
            //     $query->where('day_of_week', strtolower($dayOfWeek)) // Convert to lowercase for case-insensitive comparison
            //         ->where('start_time', '<=', $time)
            //         ->where('end_time', '>=', $time);
            // })
            ->get();
        $clients = Client::paginate(10);

        $halles = [];
        $reservations = [];
        $availableSlots = [];
        $unavailableSlots = [];
        $timeSlots = [];
        $minutesPerPackage = [];
        return response()->view('branch.reservation', compact('halles', 'packages', 'clients', 'availableSlots', 'unavailableSlots', 'timeSlots'));
    }
    public function tableSlots(Request $request)
    {
        $now = Carbon::now();

        // Query to get all reservations for today
        $reservations = Reservation::where('table_id', $request->table_id)
            ->where(function ($query) use ($now) {
                $query->whereDate('date', $now->toDateString())
                    ->whereTime('date', '>=', $now->toTimeString());
            })
            ->orderBy('date')
            ->get();

        $package = Package::find($request->packageId);
        $minutesPerPackage = $package->time;
        // Generate time slots based on the package minutes
        $startTime = Carbon::createFromTime(0, 0, 0);
        $endTime = Carbon::createFromTime(23, 59, 59);
        $timeSlots = [];

        $currentTime = clone $startTime;
        while ($currentTime->lte($endTime)) {
            $endTimeSlot = clone $currentTime;
            $endTimeSlot->addMinutes($minutesPerPackage);
            $timeSlots[] = [
                'start' => $currentTime->format('g:i A'),
                'end' => $endTimeSlot->format('g:i A'),
            ];
            $currentTime->addMinutes($minutesPerPackage);
        }
        // Calculate the available and unavailable time slots
        $availableSlots = [];
        $unavailableSlots = [];

        $prevEndTime = $startTime;
        foreach ($reservations as $reservation) {
            $start = Carbon::parse($reservation->date);
            $end = Carbon::parse($reservation->end);

            if ($prevEndTime->lt($start)) {
                $availableSlots[] = [
                    'start' => $prevEndTime->format('g:i A'),
                    'end' => $start->format('g:i A'),
                ];
            }
            $unavailableSlots[] = [
                'start' => $start->format('g:i A'),
                'end' => $end->format('g:i A'),
            ];

            $prevEndTime = $end;
        }
        if ($prevEndTime->lt($endTime)) {
            $availableSlots[] = [
                'start' => $prevEndTime->format('g:i A'),
                'end' => $endTime->format('g:i A'),
            ];
        }

        // return view('reservations.show', compact('availableSlots', 'unavailableSlots', 'timeSlots'));
        return  $render = view('branch.time_slots', compact('availableSlots', 'unavailableSlots', 'timeSlots'));
        // return response()->view('branch.calender');
    }
}
