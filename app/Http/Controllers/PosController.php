<?php

namespace App\Http\Controllers;

use App\Models\BranchAccount;
use App\Models\Casher;
use App\Models\Client;
use App\Models\Lounge;
use App\Models\Order;
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
        $currentDatetime = Carbon::now()->setTimezone('Asia/Riyadh');

        $halles = Lounge::with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى')->where('date', '<=', now()) // Check if start date is before or equal to now
                    ->where('end', '>=', now());
            }]);
        }])->where('branch_id', Auth::user()->branch_id)->get();
        $loungesSortOne = Lounge::where('sort', 1)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى')->where('date', '<=', now()) // Check if start date is before or equal to now
                    ->where('end', '>=', now());
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();

        $loungesSortow = Lounge::where('sort', 2)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى')->where('date', '<=', now()) // Check if start date is before or equal to now
                    ->where('end', '>=', now());
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();

        $halfCount = ceil($loungesSortow->tables->count() / 2);
        $firstHalfTwo = $loungesSortow->tables->slice(0, $halfCount);
        $secondHalfTwo = $loungesSortow->tables->slice($halfCount);
        $loungesSorThree = Lounge::where('sort', 4)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى')->where('date', '<=', now()) // Check if start date is before or equal to now
                    ->where('end', '>=', now());
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();


        $loungesSortowSilver = Lounge::where('sort', 3)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى')->where('date', '<=', now()) // Check if start date is before or equal to now
                    ->where('end', '>=', now());
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();

        $halfCountSilver = ceil($loungesSortowSilver->tables->count() / 2);
        $firstHalfSilverTwo = $loungesSortowSilver->tables->slice(0, $halfCountSilver);
        $secondHalfSilverTwo = $loungesSortowSilver->tables->slice($halfCountSilver);
        $tables = Table::where('branch_id', Auth::user()->id)->get();
        return response()->view('branch.home', compact('halles', 'tables', 'loungesSortOne', 'loungesSorThree', 'loungesSortow', 'loungesSortowSilver', 'firstHalfTwo', 'secondHalfTwo', 'secondHalfSilverTwo', 'firstHalfSilverTwo'));

        // return response()->view('branch.home', compact('halles'));
    }

    public function _hallesBranch(Request $request)
    {
        $halles = Lounge::where('branch_id', Auth::user()->branch_id)->with(['tables' => function ($query) use ($request) {
            $query->whereHas('packages', function ($q) use ($request) {
                $q->where('package_id', $request->id);
            });
        }])->whereHas('tables', function ($query) use ($request) {
            $query->with('packages', 'reservation')->whereHas('packages', function ($q) use ($request) {
                $q->where('package_id', $request->id);
            });
        })->get();
        return view('branch._halles_branch', compact('halles'))->render();
    }
    public function _home()
    {
        // $halles = Lounge::with(['tables' => function ($q) {
        //     $q->with(['reservation' => function ($q) {
        //         $now = Carbon::now(); // Get the current date and time
        //         $q->with(['package' => function ($q) use ($now) {
        //             $q->select('id', 'time', 'name', 'price'); // Select the necessary columns from the package table
        //         }])
        //             ->where('status', '!=', 'انتهى');
        //     }]);
        // }])->where('branch_id', Auth::user()->branch_id)->get();
        $halles = Lounge::with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى');
            }]);
        }])->where('branch_id', Auth::user()->branch_id)->get();
        $loungesSortOne = Lounge::where('sort', 1)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى');
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();

        $loungesSortow = Lounge::where('sort', 2)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى');
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();

        $halfCount = ceil($loungesSortow->tables->count() / 2);
        $firstHalfTwo = $loungesSortow->tables->slice(0, $halfCount);
        $secondHalfTwo = $loungesSortow->tables->slice($halfCount);
        $loungesSorThree = Lounge::where('sort', 4)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى');
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();


        $loungesSortowSilver = Lounge::where('sort', 3)->with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى');
            }]);
        }])
            ->where('branch_id', Auth::user()->id)
            ->first();

        $halfCountSilver = ceil($loungesSortowSilver->tables->count() / 2);
        $firstHalfSilverTwo = $loungesSortowSilver->tables->slice(0, $halfCountSilver);
        $secondHalfSilverTwo = $loungesSortowSilver->tables->slice($halfCountSilver);

        return view('branch._home', compact(
            'halles',
            'loungesSortOne',
            'loungesSorThree',
            'loungesSortow',
            'loungesSortowSilver',
            'firstHalfTwo',
            'secondHalfTwo',
            'secondHalfSilverTwo',
            'firstHalfSilverTwo'
        ))->render();
        // return view('branch._home', compact('halles'))->render();
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
        $halles = Lounge::with(['tables' => function ($q) {
            $q->with(['reservation' => function ($q) {
                $q->where('status', '!=', 'انتهى');
            }]);
        }])->where('branch_id', Auth::user()->branch_id)->get();

        return view('branch._halls', compact('halles'));
    }
    public function hallsNew()
    {
        $halles = Lounge::with('tables')->where('branch_id', Auth::user()->branch_id)->get();
        $loungesSortOne = Lounge::where('sort', 1)->with('tables')
            ->where('branch_id', Auth::user()->id)
            ->first();

        $loungesSortow = Lounge::where('sort', 2)->with('tables')
            ->where('branch_id', Auth::user()->id)
            ->first();

        $halfCount = ceil($loungesSortow->tables->count() / 2);
        $firstHalfTwo = $loungesSortow->tables->slice(0, $halfCount);
        $secondHalfTwo = $loungesSortow->tables->slice($halfCount);
        $loungesSorThree = Lounge::where('sort', 4)->with('tables')
            ->where('branch_id', Auth::user()->id)
            ->first();


        $loungesSortowSilver = Lounge::where('sort', 3)->with('tables')
            ->where('branch_id', Auth::user()->id)
            ->first();

        $halfCountSilver = ceil($loungesSortowSilver->tables->count() / 2);
        $firstHalfSilverTwo = $loungesSortowSilver->tables->slice(0, $halfCountSilver);
        $secondHalfSilverTwo = $loungesSortowSilver->tables->slice($halfCountSilver);
        return  $render = view('branch.halles', compact('halles', 'loungesSortOne', 'loungesSorThree', 'loungesSortow', 'loungesSortowSilver', 'firstHalfTwo', 'secondHalfTwo', 'secondHalfSilverTwo', 'firstHalfSilverTwo'));
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
            $reservationDateTime = $item->date;
            $color = '#48cfcf';
            $newData[$index]['id']        = $item->id;
            $str = explode(' ', $item->package->name);
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

        $data = Reservation::whereBetween('date', [Carbon::now()->subMonth(2), Carbon::now()->addMonth(6)])
            ->get();

        if ($request->ajax()) {
            $data = Reservation::whereDate('date', '>=', $request->start)
                ->get();
            $newData = [];
            foreach ($data as $index => $item) {
                $reservationDateTime = $item->date;
                $color = '#48cfcf';
                $newData[$index]['id']        = $item->id;
                $str = explode(' ', $item->package->name);
                $newData[$index]['title']     = "\n" . $item->package->name . "\n";
                $newData[$index]['start']     = $reservationDateTime;
                $newData[$index]['color']       = $color;
            }

            return response()->json($newData);
        } else {
            foreach ($data as $index => $item) {
                $reservationDateTime = $item->date;
                $color = '#48cfcf';
                $newData[$index]['id']        = $item->id;
                $str = explode(' ', $item->package->name);
                $newData[$index]['title']     = "\n" . $item->package->name . "\n";
                $newData[$index]['start']     = $reservationDateTime;
                $newData[$index]['color']       = $color;
            }
        }
        return view('branch.reserv', compact('newData'));
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
            $q->where('status', '!=', 'انتهى');
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
        $reservation = null;
        $availableSlots = [];
        $unavailableSlots = [];
        $timeSlots = [];
        $minutesPerPackage = [];
        return response()->view('branch.reservation', compact('halles', 'packages', 'clients', 'availableSlots', 'unavailableSlots', 'timeSlots', 'reservation'));
    }
    public function tableSlots(Request $request)
    {
        $now = Carbon::now()->setTimezone('Asia/Riyadh'); // Set the time zone to Saudi Arabia

        // Query to get all reservations for today
        $reservations = Reservation::where('table_id', $request->table_id)
            ->where(function ($query) use ($now) {
                $query->whereDate('date', $now);
            })
            ->orderBy('date')
            ->get();

        $package = Package::find($request->packageId);
        $minutesPerPackage = $package->time;

        // Generate time slots based on the package minutes
        $startTime = Carbon::createFromTime(0, 0, 0)->tz('Asia/Riyadh'); // Set the time zone to Saudi Arabia
        $endTime = Carbon::createFromTime(23, 59, 59)->tz('Asia/Riyadh'); // Set the time zone to Saudi Arabia
        $timeSlots = [];

        $currentTime = clone $startTime;
        while ($currentTime->lte($endTime)) {
            $endTimeSlot = clone $currentTime;
            $endTimeSlot->addMinutes($minutesPerPackage);

            // Check if the time slot is in the future
            if ($endTimeSlot->isFuture()) {
                $timeSlots[] = [
                    'start' => $currentTime->format('g:i A'),
                    'end' => $endTimeSlot->format('g:i A'),
                ];
            }

            $currentTime->addMinutes($minutesPerPackage);
        }

        // Calculate the unavailable time slots
        $unavailableSlots = [];
        foreach ($reservations as $reservation) {
            $start = Carbon::parse($reservation->date)->tz('Asia/Riyadh'); // Set the time zone to Saudi Arabia
            $end = Carbon::parse($reservation->end)->tz('Asia/Riyadh'); // Set the time zone to Saudi Arabia

            $unavailableSlots[] = [
                'start' => $start->format('g:i A'),
                'end' => $end->format('g:i A'),
            ];
        }

        // Calculate the available time slots by removing reserved slots from all slots
        $availableSlots = array_filter($timeSlots, function ($slot) use ($unavailableSlots) {
            foreach ($unavailableSlots as $unavailableSlot) {
                if ($slot['start'] === $unavailableSlot['start'] && $slot['end'] === $unavailableSlot['end']) {
                    return false; // Slot is reserved, so it's not available
                }
            }
            return true; // Slot is available
        });

        // Now you can use the $availableSlots and $unavailableSlots arrays as needed


        return  $render = view('branch.time_slots', compact('availableSlots', 'unavailableSlots', 'timeSlots'));
        // return response()->view('branch.calender');
    }

    public function casher()
    {
        $cashers =  Casher::orderBy('date', 'desc')->whereDate('date', Carbon::today())->where('branch_id', Auth::user()->id)->paginate(50);

        $reservationPayment = Reservation::whereDate('date', Carbon::today())->with('table')->whereHas('table', function ($q) {
            $q->where('branch_id', Auth::user()->id);
        });
        $visa = Reservation::whereDate('date', Carbon::today())->where('payment_type', "بطاقة ائتمان")->with('table')->whereHas('table', function ($q) {
            $q->where('branch_id', Auth::user()->id);
        })->sum('price');
        $cash = $reservationPayment->where('payment_type', 'كاش')->sum('price');
        // $visa = $reservationPayment->where('payment_type', "بطاقة ائتمان")->sum('price');
        $online = $reservationPayment->where('payment_type', 'online')->sum('price');
        $point = Reservation::whereDate('date', Carbon::today())->with('table')->whereHas('table', function ($q) {
            $q->where('branch_id', Auth::user()->id);
        })->sum('price');
        $order = $sumProductQuantity = OrderProduct::whereDate('created_at', Carbon::today())->where('payment_type', '!=', 'دفع إلكتروني')
            ->sum(DB::raw('price * quantity'));

        return view('branch.casher', compact('visa', 'cash', 'online', 'cashers', 'order', 'point'));
    }

    public function activeTable($id)
    {
          $reservation =  Reservation::where('table_id', $id)->where('status', '!=', 'انتهى')
            ->where('date', '<=', now())
            ->where('end', '>=', now())->first();
            if($reservation){
        $table = Table::find($id);
        $table->status = 'in_service';
        $isSaved = $table->update();
      
        $reservation->status = 'تم الحضور';
        $reservation = $reservation->update();
            }else{
                      return response()->json(['icon' => 'error', 'title' => ' created faild'], $isSaved ? 201 : 400);
  
            }

        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }
    public function activeReservation($id)
    {
        $reservation = Reservation::find($id);
        $table = Table::find($reservation->table_id);

        $table->status = 'in_service';
        $table->update();
        $reservation->status = 'تم الحضور';
        $isSaved =
            $reservation->update();
        return response()->json(['icon' => 'success', 'title' => 'created successfully'], $isSaved ? 201 : 400);
    }
    public function closeTable($id)
    {
        $table = Table::find($id);
        $table->status = 'available';
        $isSaved = $table->update();

        $reservation =  Reservation::where('table_id', $id)->where('status', '!=', 'انتهى')
            ->where('date', '<=', now())
            ->where('end', '>=', now())->first();
        $reservation->status = 'انتهى';
        $order = Order::where([['table_id', $reservation->table_id], ['package_id', $reservation->package_id], ['is_done', 0]])->first();
        if ($order) {
            $order->is_done = 1;
            $order->update();
        }
        $reservation = $reservation->update();
        return response()->json(['icon' => 'success', 'title' => 'created successfully'], $isSaved ? 201 : 400);
    }
}
