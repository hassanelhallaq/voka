<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index()
    {
        $categories = Department::paginate(50);
        return view('dashboard.department.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $client = new Department();
        $client->name = $request->name;
        $isSaved = $client->save();
        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }

    public function update(Request $request, $id)
    {
        $client =  Department::find($id);
        $client->name = $request->name;
        $isSaved = $client->save();
        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }
}
