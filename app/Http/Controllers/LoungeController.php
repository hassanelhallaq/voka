<?php

namespace App\Http\Controllers;

use App\Http\Requests\lounge\StoreloungeRequest;
use App\Models\Lounge;
use Illuminate\Http\Request;

class LoungeController extends Controller
{
    public function index($id)
    {
        $lounges = Lounge::where('branch_id', $id)->get();
        return view('dashboard.lounges.index', compact('lounges', 'id'));
    }
    public function create()
    {
        return view('dashboard.lounges.create');
    }

    public function store(StoreloungeRequest $request, $id)
    {
        $lounge = new Lounge();
        $lounge->name = $request->get('name');
        $lounge->name_en = $request->get('name_en');
        $lounge->branch_id = $id;
        $isSaved = $lounge->save();
        if ($isSaved) {
            toastr()->success('Lounge store successfully.');
        } else {
            toastr()->error('Lounge store unsuccessfully.');
        }
        return redirect()->back();
    }
}
