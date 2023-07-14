<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $isSaved = $client->save();
        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }
}
