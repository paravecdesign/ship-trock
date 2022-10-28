<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ShipperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return Inertia::render('Admin/Shipper/Index', [
            'shippers' => Shipper::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('shippers')->withoutTrashed(),
                ]
            ]
        );


        $shippers = Shipper::create([
            'name' => $request->name,
        ]);


        return redirect()->back()->with('success', 'New Shipper Added.');
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


        return Inertia::render('Admin/Shipper/Edit', [
            'shippers' => Shipper::paginate(5),
            'shipper' => Shipper::find($id),
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
        $shippers = Shipper::find($id);
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('shippers','name')->ignore($shippers->id)->withoutTrashed(),
            ],
        ]);

        $shippers->update($data);

        return redirect()->back()->with('success', 'Shipper updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $shipper = Shipper::find($id);
        $shipper->delete();

        return redirect()->back()->with('error', 'Shipper deleted.');

    }
}
