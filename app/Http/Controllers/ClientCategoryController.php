<?php

namespace App\Http\Controllers;

use App\Models\ClientCategory;
use Illuminate\Http\Request;

class ClientCategoryController extends Controller
{
    public function index()
    {
        $categories = ClientCategory::paginate(50);
        return view('dashboard.clientCategory.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $client = new ClientCategory();
        $client->name = $request->name;
        $isSaved = $client->save();
        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }

    public function update(Request $request, $id)
    {
        $client =  ClientCategory::find($id);
        $client->name = $request->name;
        $isSaved = $client->save();
        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }
}
