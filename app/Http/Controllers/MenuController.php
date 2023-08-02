<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ProductCategory;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($id, $branch_id)
    {
        $branch = Branch::find($branch_id);
        $table = Table::find($id);
        // $reservation = Reservation::where([['table_id', $id], ['status', 'مؤكد']])->first();
        // if (!$reservation) {
        //     return view('errors.400');
        // }
        $reservation = Reservation::where([['table_id', $id], ['id', 25]])->first();

        $categories = ProductCategory::where('category_status', 1)
            ->with([
                'branch' => function ($query) use ($branch_id) {
                    $query->where('branch_id',  $branch_id);
                }, 'Product' => function ($query) {
                    $query->where('status',  1);
                }
            ])
            ->orderBy('category_order', 'asc')
            ->whereHas('branch', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })

            ->get();
        return view('menu.home', compact(
            'categories',
            'branch',
            'table',
            'reservation'
        ));
    }

    public function cart($id, $branch_id)
    {
        $branch = Branch::find($branch_id);
        $table = Table::find($id);
        return view('menu.cart', compact(
            'branch',
            'table'
        ));
    }
}
