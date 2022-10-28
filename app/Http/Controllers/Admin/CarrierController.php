<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Carrier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Carrier/Index', [
            'carriers' => Carrier::paginate(5)
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
                    Rule::unique('carriers')->withoutTrashed(),
                ]
            ]
        );


        $carriers = Carrier::create([
            'name' => $request->name,
        ]);


        return redirect()->back()->with('success', 'New Carrier Has Been Added.');
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


        return Inertia::render('Admin/Carrier/Edit', [
            'carriers' => Carrier::paginate(5),
            'carrier' => Carrier::find($id),
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
        $carriers = Carrier::find($id);
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('carriers','name')->ignore($carriers->id)->withoutTrashed(),
            ],
        ]);

        $carriers->update($data);

        return redirect()->back()->with('success', 'The Carrier has Been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $carrier = Carrier::find($id);
        $carrier->delete();

        return redirect()->back()->with('error', 'The Carrier Has been deleted.');

    }
}
