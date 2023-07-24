<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::with('orders', 'wallet', 'reservation', 'packages')->withCount('packages', 'orders')->withSum('packages', 'price')->paginate(50);
        return view('dashboard.client.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $isSaved = $client->save();
        return response()->json(['icon' => 'success', 'title' => ' created successfully'], $isSaved ? 201 : 400);
    }

    public function show($id)
    {
        $client = Client::with(['orders' => function ($q) {
            $q->with('products');
        }, 'packages'])->find($id);
        return view('dashboard.client.show', compact('client'));
    }
}
