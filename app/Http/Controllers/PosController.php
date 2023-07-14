<?php

namespace App\Http\Controllers;

use App\Models\Lounge;
use App\Models\Package;
use App\Models\ProductCategory;
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
        $date = date('Y-m-d'); // Get the current date
        $time = date('H:i:s'); // Get the current time
        $packages = Package::where('branch_id', Auth::user()->branch_id)->whereHas('schedules', function ($query) use ($date, $time) {
            $query->where('day_of_week', strtolower(date('l', strtotime($date))))
                ->where('start_time', '<=', $time)
                ->where('end_time', '>=', $time);
        })->get();
        $halles = Lounge::with('tables')->where('branch_id', Auth::user()->branch_id)->get();
        return response()->view('branch.reservation', compact('halles', 'packages'));
    }
    public function _hallesBranch(Request $request)
    {
        $halles = Lounge::with('tables')->whereHas('tables', function ($query) use ($request) {
            $query->where('lounge_id', $request->id);
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
}
