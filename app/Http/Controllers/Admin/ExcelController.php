<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rate;
use App\Models\Shipments;
use Illuminate\Http\Request;
use App\Imports\ShipmentImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    function is_decimal($n)
    {
        // Note that floor returns a float
        return is_numeric($n) && floor($n) != $n;
    }
    public function import(Request $request){

        // if ($this->is_decimal($request['Wgt'])) {
        //     $rate = $request['wgt'] + 1;
        //     $freight = Rate::where('weight', intval($rate))->first();
        // } else {
        //     $rate = $request['Wgt'];
        //     $freight = Rate::where('weight', intval($rate))->first();
        // }
        // dd($request['manifest']['Wgt']);
        // Shipments::create([
        //     'rate_id'    => $freight->id,
        //     'weight'    => $request->weight,
        // ]);
        // $shipments->rate_id = $freight->id;
        // $shipments->weight = $request->weight;
        // $shipments->save();
        Excel::import(new ShipmentImport, $request->file('manifest'));
        return redirect()->back()->with('success', 'Manifest Uploaded Successfully.');
    }


    public function export()
    {
        return Excel::download(new ManifestExport, 'users.xlsx');
    }
}
