<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::paginate(10);
        return view('dashboard.shifts.index', compact('shifts'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Create a new Shift instance and store the data in the database
        Shift::create([
            'day' => $request->input('day'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        // Redirect to a route or URL after storing the shift
        return redirect()->route('shifts.index')->with('success', 'Shift created successfully');
    }

    public function destroy($id)
    {
        $record = Shift::find($id);
        $record->forceDelete();
        return response()->json(['icon' => 'success', 'title' => 'تم الحذف  بنجاح'], 200);
    }
}
