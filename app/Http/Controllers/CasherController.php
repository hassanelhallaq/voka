<?php

namespace App\Http\Controllers;

use App\Models\Casher;
use App\Models\UplaodCasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClosingShifts;
use App\Models\Income;
use App\Models\Reservation;
use Carbon\Carbon;

class CasherController extends Controller
{
    public function index(Request $request)
    {
        $date =  $request->date ?? Carbon::now()->format('Y-m');
        $cashers =  Casher::with('branch')->orderBy('date', 'desc')->paginate(50);

        return view('dashboard.casher.index', compact('cashers'));
    }
    public function create()
    {
        $reservationPayment = Reservation::whereDate('date', Carbon::today());
        $cash = $reservationPayment->where('payment_type', 'كاش')->sum('price');
        $visa = $reservationPayment->where('payment_type', 'بطاقة ائتمان')->sum('price');
        $online = $reservationPayment->where('payment_type', 'online')->sum('price');

        return view('dashboard.casher.create', compact('visa', 'cash', 'online'));
    }
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'cash' => 'required',
            'cash_found' => 'required',
            'credit' => 'required',
            'date' => 'required',
            'remarks' => 'required',
            'expenses_sum' => 'required',
            'credit_trans' => 'required',
            'online' => 'required',
            'online_trans' => 'required',
            'status_cash' => 'required',
            'credit_sum' => 'required',
            'credit_status' => 'required',
            'online_sum' => 'required',
            'point' => 'required',
            'point_trans' => 'required',
            'point_sum' => 'required',
            'point_status' => 'required',
            'shift_type' => 'required',
        ]);
        if (!$validator->fails()) {
            $casher = new Casher();
            $casher->cash = $request->get('cash');
            $casher->cash_found = $request->get('cash_found');
            $casher->credit = $request->get('credit');
            $casher->date = $request->get('date');
            $casher->remarks = $request->get('remarks');
            $casher->expenses_sum = $request->get('expenses_sum');
            $casher->credit_trans = $request->get('credit_trans');
            $casher->online_trans = $request->get('online_trans');
            $casher->online = $request->get('online');
            $casher->online_trans = $request->get('online_trans');
            $casher->status_cash = $request->get('status_cash');
            $casher->credit_sum = $request->get('credit_sum');
            $casher->credit_status = $request->get('credit_status');
            $casher->online_sum = $request->get('online_sum');
            $casher->point = $request->get('point');
            $casher->point_trans = $request->get('point_trans');
            $casher->point_sum = $request->get('point_sum');
            $casher->point_status = $request->get('point_status');
            $casher->shift_type = $request->get('shift_type');
            $casher->online_status = $request->get('online_status');
            $casher->branch_id = Auth::user()->id;
            $casher->status = 'underreview';
            $isSaved = $casher->save();
            if ($isSaved) {
                return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
            } else {

                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    public function edit($id)
    {
        $casher =   Casher::find($id);
        return view('dashboard.casher.edit', compact('casher'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'cash' => 'required',
            'cash_found' => 'required',
            'credit' => 'required',
            'date' => 'required',
            'remarks' => 'required',
            'expenses_sum' => 'required',
            'credit_trans' => 'required',
            'online' => 'required',
            'online_trans' => 'required',
            'status_cash' => 'required',
            'credit_sum' => 'required',
            'credit_status' => 'required',
            'online_sum' => 'required',
            'point' => 'required',
            'point_trans' => 'required',
            'point_sum' => 'required',
            'point_status' => 'required',
            'shift_type' => 'required',
        ]);
        if (!$validator->fails()) {
            $casher =  Casher::find($id);
            $casher->cash = $request->get('cash');
            $casher->cash_found = $request->get('cash_found');
            $casher->credit = $request->get('credit');
            $casher->date = $request->get('date');
            $casher->remarks = $request->get('remarks');
            $casher->expenses_sum = $request->get('expenses_sum');
            $casher->credit_trans = $request->get('credit_trans');
            $casher->online_trans = $request->get('online_trans');
            $casher->online = $request->get('online');
            $casher->online_trans = $request->get('online_trans');
            $casher->status_cash = $request->get('status_cash');
            $casher->credit_sum = $request->get('credit_sum');
            $casher->credit_status = $request->get('credit_status');
            $casher->online_sum = $request->get('online_sum');
            $casher->point = $request->get('point');
            $casher->point_trans = $request->get('point_trans');
            $casher->point_sum = $request->get('point_sum');
            $casher->point_status = $request->get('point_status');
            $casher->shift_type = $request->get('shift_type');
            $casher->status = $request->get('status');
            $casher->online_status = $request->get('online_status');
            $isSaved = $casher->save();
            if ($isSaved) {

                return ['redirect' => route('cashers.index')];
                // return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
            } else {

                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    public function destroy($id)
    {
        $casher =  Casher::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'تم الحذف  بنجاح'], $casher ? 200 : 400);
    }
}
