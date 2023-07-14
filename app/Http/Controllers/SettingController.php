<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('dashboard.settings.index', compact('settings'));
    }
    public function ajaxSettingStatus(Request $request)
    {

        $setting = Setting::find($request->id);
        $setting->status = $request->unit_toggle_value;
        $setting->update();
        return true;
    }
}
