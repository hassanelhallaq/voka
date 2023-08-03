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
        $cashers =  Casher::with('employee')->orderBy('date', 'desc')->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$date])->paginate(50);

        return view('dashboard.casher.index', compact('cashers'));
    }
    public function create()
    {
        $reservation = Reservation::whereDate('date', Carbon::today())->sum('price');
        return view('dashboard.casher.create', compact('reservation'));
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
            $isSaved = $casher->save();

            if ($isSaved) {

                return ['redirect' => route('cashers.index')];
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
        ]);
        if (!$validator->fails()) {
            $casher =   Casher::find($id);
            $casher->cash = $request->get('cash');
            $casher->cash_found = $request->get('cash_found');
            $casher->credit = $request->get('credit');
            $casher->date = $request->get('date');
            $casher->remarks = $request->get('remarks');
            $casher->expenses_sum = $request->get('expenses_sum');
            $casher->credit_trans = $request->get('credit_trans');
            $isSaved = $casher->update();

            if ($isSaved) {
                // $role = Role::where('id', $request->role_id)->first();
                // $casher->assignRole($role->id);
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
