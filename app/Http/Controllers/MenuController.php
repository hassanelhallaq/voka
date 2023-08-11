<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\Table;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        // $setting = Setting::find(1);
        // if ($setting->status == 'DEACTIVE') {
        //     return view('errors.400');
        // }
    }
    public function index($id, $branch_id)
    {
        $branch = Branch::find($branch_id);
        $table = Table::find($id);

        $reservation = Reservation::where([['table_id', $id], ['status', 'مؤكد']])->first();
        if (!$reservation && $reservation->status == 'انتهى') {
            return view('errors.404');
        }
        // $reservation = Reservation::where([['id', 25]])->first();
        $reservation->status = 'تم الحضور';
        $reservation->update();
        if ($reservation->status != 'انتهى') {
            $table->status = "in_service";
            $table->update();
        }
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
        // $reservation = Reservation::where([['table_id', $id], ['status', 'مؤكد']])->first();
        // if (!$reservation) {
        //     return view('errors.400');
        // }
        $reservation = Reservation::where([['id', 25]])->first();
        $branch = Branch::find($branch_id);
        $table = Table::find($id);
        return view('menu.cart', compact(
            'branch',
            'table',
            'reservation'
        ));
    }

    public function product($id, $branch_id, $product_id)
    {
        // $reservation = Reservation::where([['table_id', $id], ['status', 'مؤكد']])->first();
        // if (!$reservation) {
        //     return view('errors.400');
        // }
        $reservation = Reservation::where([['id', 25]])->first();
        $branch = Branch::find($branch_id);
        $table = Table::find($id);
        $product = Product::find($product_id);
        return view('menu.product', compact(
            'branch',
            'table',
            'reservation',
            'product'
        ));
    }
}
