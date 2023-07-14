<?php

namespace App\Http\Controllers;

use App\Http\Requests\table\StoreTableRequest;
use App\Models\Lounge;
use App\Models\Table;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    public function store(StoreTableRequest $request, $id)
    {
        $lounge =  Lounge::find($id);
        $table = new Table();
        $table->name = $request->get('name');
        $table->branch_id = $lounge->branch_id;
        $table->lounge_id = $id;
        $table->status = 'available';
        $isSaved = $table->save();
        $qrImage = 'images' . $id . $table->id . '.svg';
        $url =  'test.com/' . $id . '/table/' . $table->id;
        QrCode::format('svg');
        QrCode::generate($url, $qrImage);
        $table->qr = $qrImage;
        $table->save();
        if ($isSaved) {
            toastr()->success('Table store successfully.');
        } else {
            toastr()->error('Table store unsuccessfully.');
        }
        return redirect()->back();
    }


    public function ajaxTableBranches(Request $request)
    {
        $brnachId = $request->id;
        $tables = Table::where('branch_id', $brnachId)
            ->get();
        return response()->json($tables);
    }
}
