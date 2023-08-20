<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);
        $tableAv = Table::where('status', 'available')->count();
        $tableService = Table::where('status', 'in_service')->count();
        $reservationOnline = Reservation::where('payment_type', 'online')->sum('price');
        $reservationOnlineToday = Reservation::where([['payment_type', 'online'], ['created_at', Carbon::today()]])->sum('price');


        $mostSellingProducts = Order::select(
            'products.product_id',
            'products.name',
            DB::raw('SUM(order_products.quantity) as total_quantity'),
            DB::raw('SUM(products.price * order_products.quantity) as total_revenue'),
            DB::raw('(SELECT file_name FROM media WHERE model_id = products.product_id AND model_type = "App\Models\Product" LIMIT 1) as product_photo')
        )
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'order_products.product_id', '=', 'products.product_id')
            ->groupBy('products.product_id', 'products.name')
            ->orderByDesc('total_quantity')
            ->take(4) // Adjust the number to get the top N selling products
            ->get();



        $reservationOnlineFinish = Reservation::where('status', 'انتهى')
            ->whereDate('created_at', Carbon::today())
            ->groupBy('package_id')
            ->selectRaw('package_id, COUNT(*) as reservation_count, SUM(price) as total_price')->take(4)
            ->get();
        $branchSales = Branch::with('tables.reservations')
            ->select('branches.id', 'branches.name')
            ->selectRaw('SUM(reservations.price) as total_sales')
            ->join('tables', 'branches.id', '=', 'tables.branch_id')
            ->join('reservations', 'tables.id', '=', 'reservations.table_id')
            ->where('reservations.status', 'انتهى')
            ->whereDate('reservations.created_at', Carbon::today())
            ->groupBy('branches.id', 'branches.name')
            ->get();
        // Calculate the product of price and count for each group

        return view('pages.dashboards.index', compact('tableAv', 'tableService', 'reservationOnline', 'reservationOnlineToday', 'mostSellingProducts', 'branchSales', 'reservationOnlineFinish'));
    }

    public function show_translate()
    {
        $language = session()->get('lang');
        return view('dashboard.languages.language_view_en', compact('language'));
    }
    public function changeLanguage(Request $request, $language)
    {
        // dd($language);
        $status = in_array($language, ['ar', 'en']);
        $lang = $status ? $language : 'ar';
        App::setLocale($lang);
        $request->session()->put('lang', $lang);
        // dd(session()->get('lang') . ' CURRENT: ' . App::currentLocale());
        return redirect()->back();
    }
    public function key_value_store(Request $request)
    {
        $data = $this->openJSONFile($request->id);
        foreach ($request->key as $key => $key) {
            $data[$key] = $request->key[$key];
        }
        saveJSONFile($request->id, $data);
        return back();
    }

    function openJSONFile($code)
    {

        $jsonString = [];
        $filePath = base_path('resources/lang/' . $code . '.json');

        if (file_exists($filePath)) {
            try {

                $jsonString = file_get_contents($filePath);
                $jsonString = json_decode($jsonString, true);
            } catch (\Exception $e) {

                // Handle the error or log it for debugging purposes.
                // For example:
                Log::error('Error decoding JSON file: ' . $e->getMessage());
            }
        }

        return $jsonString;
    }
}
