<?php

namespace App\Http\Controllers;

use App\Http\Requests\coupons\StoreCouponsRequest;
use App\Models\Branch;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('dashboard.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('dashboard.coupons.create', compact('branches'));
    }

    public function store(StoreCouponsRequest $request)
    {
        $data = $request->all();
        $data['is_customer'] = $request->is_customer == 'on' ? 1 : 0;
        $isSaved =   Coupon::create($data);
        if ($isSaved) {
            toastr()->success('Coupon store successfully.');
        } else {
            toastr()->error('Coupon store unsuccessfully.');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $branches = Branch::all();
        return view('dashboard.coupons.create', compact('branches'));
    }
}
