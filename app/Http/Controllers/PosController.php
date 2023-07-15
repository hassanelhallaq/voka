<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lounge;
use App\Models\Package;
use App\Models\ProductCategory;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function home()
    {
        $halles = Lounge::with('tables')->where('branch_id', Auth::user()->branch_id)->get();
        return response()->view('branch.home', compact('halles'));
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

        $halles = Lounge::with('tables')->where('branch_id', Auth::user()->branch_id)->get();
        return response()->view('branch.reservation', compact('halles', 'packages', 'clients'));
    }
    public function _hallesBranch(Request $request)
    {
        $halles = Lounge::with(['tables' => function ($query) use ($request) {
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
        $halles = Lounge::with('tables')->where('branch_id', Auth::user()->branch_id)->get();
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
    public function resver()
    {
        $dayOfWeek = Carbon::now()->format('l');
        $time = Carbon::now()->format('H:i:s');
        $reservations = Reservation::all();
        return  $render = view('branch.reserv', compact('reservations'));
    }
}
