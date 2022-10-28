<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ManifestExport;
use App\Models\Rate;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Status;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Models\Shipments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StatusResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ShipmentResource;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->users = CustomerResource::collection(User::all());
        $this->shippers = Shipper::get();
        $this->statuses = StatusResource::collection(Status::get());
        $this->rates = Rate::all();
        $this->carriers = Carrier::get();
    }

    function is_decimal($n)
    {
        // Note that floor returns a float
        return is_numeric($n) && floor($n) != $n;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:shipment_number,created_at'],
        ]);
        $query =  Shipments::with('status', 'rate', 'customer', 'shipcourier');

        // dd($query->paginate(15));
        if (request('search')) {
            $query->where('shipment_number', 'LIKE',  '%' . request('search') . '%');
        }
        if (request('statusfilter')) {
            $query->where('status_id', request('statusfilter'));
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        } else {
            $query->orderBy('created_at', 'desc');
        }
        // dd(Request('statusfilter'));
        return Inertia::render('Admin/Shipments/Index', [
            'shipments' => $query->paginate(15)->through(function ($shipment) {
                return [
                    'id' => $shipment->id,
                    'shipment_number' => $shipment->shipment_number ?? '',
                    'date' => $shipment->date ?? '',
                    'states_name' => $shipment->status->name ?? '',
                    'weight' => $shipment->weight ?? '',
                    'tracking_number' => $shipment->tracking_number ?? '',
                    'created_at' => $shipment->created_at->toDateString() ?? '',
                    'freight' => $shipment->freight ?? '',
                    'courier' => $shipment->shipcourier->name ?? '',
                    'customer_name' => $shipment->customer->name ?? '',
                ];
            }),


            'filters' => request()->all(['search', 'field', 'direction', 'statusfilter']),
            'statuses' => $this->statuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function bulkupdate()
    {
        $selected = request('data');
        // dd($selected['shipmentIds']);
        Status::find($selected['statusId'])->shipmentsStatus()->attach($selected['shipmentIds']);
        if (!empty($selected['shipmentIds'])) {
            Shipments::whereIn('id', $selected['shipmentIds'])->update(['status_id' => $selected['statusId']]);
            $this->selectedItems = [];
            return Redirect::route('admin.shipments.index')->with('success','Records Updated Successfully.');
        } else {
            // dd('no');
            return Redirect::route('admin.shipments.index')->with('success','Please select some Records.');
        }


    }
    public function create()
    {

        return Inertia::render('Admin/Shipments/Create', [
            'customers' => $this->users,
            'shippers' => $this->shippers,
            'carriers' => $this->carriers,
            'statuses' => $this->statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $shipments = new Shipments;

        $request->validate([
            'status_id' => 'required',
            'date' => 'required',
            'shipper_id' => 'required',
            'customer_id' => 'required',
            'carrier_id' => 'required',
            'weight' => 'required',
            'volume' => 'numeric',
            'itemcost' => 'numeric',
            'tracking_number' => 'required',
        ]);
        // dd($request);

        if ($this->is_decimal($request['weight'])) {
            $rate = $request['weight'] + 1;
            $freight = Rate::where('weight', intval($rate))->first();
        } else {
            $rate = $request['weight'];
            $freight = Rate::where('weight', intval($rate))->first();
        }



        $shipments->status_id = $request->status_id;
        $shipments->date = $request->date;
        $shipments->shipper_id = $request->shipper_id;
        $shipments->customer_id = $request->customer_id;
        $shipments->carrier_id = $request->carrier_id;
        $shipments->volume = $request->volume;
        $shipments->weight = $request->weight;
        $shipments->freight = $freight->cost;
        $shipments->itemcost = $request->itemcost;
        $shipments->tracking_number = $request->tracking_number;

        $shipments->save();
        return Redirect::route('admin.shipments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Admin/Shipments/Edit', [
            'shipment' => Shipments::find($id),
            'customers' => $this->users,
            'shippers' => $this->shippers,
            'carriers' => $this->carriers,
            'statuses' => $this->statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $shipments = Shipments::find($id);
        $request->validate([
            'status_id' => 'required',
            'date' => 'required',
            'shipper_id' => 'required',
            'customer_id' => 'required',
            'carrier_id' => 'required',
            'weight' => 'required',
            'volume' => 'numeric',
            'itemcost' => 'numeric',
            'tracking_number' => 'required',
        ]);
        // dd($request);

        if ($this->is_decimal($request['weight'])) {
            $rate = $request['weight'] + 1;
            $freight = Rate::where('weight', intval($rate))->first();
        } else {
            $rate = $request['weight'];
            $freight = Rate::where('weight', intval($rate))->first();
        }



        $shipments->status_id = $request->status_id;
        $shipments->date = $request->date;
        $shipments->shipper_id = $request->shipper_id;
        $shipments->customer_id = $request->customer_id;
        $shipments->carrier_id = $request->carrier_id;
        $shipments->weight = $request->weight;
        $shipments->volume = $request->volume;
        $shipments->freight = $freight->cost;
        $shipments->itemcost = $request->itemcost;
        $shipments->tracking_number = $request->tracking_number;

        $shipments->save();
        return redirect()->back()->with('success', 'Shipper updated.');
        // return Redirect::route('admin.shipments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $shipment = Shipments::find($id);
        $shipment->delete();
    }


}
