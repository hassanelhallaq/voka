<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        return view('pages.dashboards.index');
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
