<?php

namespace App\Http\Controllers;

use App\Http\Requests\packages\StorePackagesRequest;
use App\Models\Branch;
use App\Models\Package;
use App\Models\PackageSchedule;
use App\Models\Product;
use Illuminate\Http\Request;

class PackageController extends Controller
{


    public function index()
    {
        $packages = Package::paginate(10);
        return view('dashboard.package.index', compact('packages'));
    }
    public function create()
    {
        $branches = Branch::all();
        return view('dashboard.package.create', compact('branches'));
    }

    public function store(StorePackagesRequest $request)
    {

        $package =   new Package();
        $package->name = $request->name;
        $package->name_en = $request->name_en;
        $package->price = $request->price;
        $package->discount = $request->discount;
        $package->time = $request->time;
        $package->branch_id = $request->branch_id;
        $package->table_id = $request->table_id;
        $package->save();
        $dayOfWeeks = $request->input('day_of_week');
        $startTimes = $request->input('start_time');
        $endTimes = $request->input('end_time');
        foreach ($dayOfWeeks as $key => $dayOfWeek) {
            $schedule = new PackageSchedule();
            $schedule->day_of_week = $dayOfWeek;
            $schedule->start_time = $startTimes[$key];
            $schedule->end_time = $endTimes[$key];
            $schedule->package_id = $package->id;
            $schedule->save();
        }
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $imageName = time() . '_' . $package->id . '.' . $file->getClientOriginalExtension();
            $package->addMedia($file)->usingFileName($imageName)->toMediaCollection('package');
        }
        if ($package) {
            toastr()->success('Coupon store successfully.');
        } else {
            toastr()->error('Coupon store unsuccessfully.');
        }
        return redirect()->back();
    }


    public function ajaxPackageStatus(Request $request)
    {
        $setting = Package::find($request->id);
        $setting->status = $request->unit_toggle_value;
        $setting->update();
        return true;
    }
}
