<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return Inertia::render('Admin/Rate/Index', [
            'rates' => Rate::paginate(5)
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


        $request->validate([
            'weight' => 'required|string|max:255|max:255|unique:rates',
            'cost' => 'required|string|max:255|unique:rates',
        ]);

        $rates = Rate::create([
            'weight' => $request->weight,
            'cost' => $request->cost,
        ]);


        return Redirect::route('admin.setting.rates.index')->with('success', 'New Shipping Has Been Added.');
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


        return Inertia::render('Admin/Rate/Edit', [
            'rates' => Rate::paginate(),
            'rate' => Rate::find($id),
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
        $rates = Rate::find($id);



        $data = $request->validate([
            'weight' => ['required', 'unique:rates,weight,'.$rates->id],
            'cost' => ['required', 'unique:rates,cost,'.$rates->id],
        ]);

        $rates->update($data);


        return Redirect::route('admin.setting.rates.index')->with('success', 'Shipping Rate updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $rate = Rate::find($id);
        $rate->delete();

        return Redirect::route('admin.setting.rates.index')->with('error', 'Shipper deleted.');
    }
}
