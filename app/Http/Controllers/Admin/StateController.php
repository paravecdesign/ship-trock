<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = NULL)
    {

            $states = State::with('cities')->where('country_id',$id)->paginate(8);


        // dd($states);
        return Inertia::render('Admin/State/Index', [
            'states' => $states,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $state = State::with('cities')->find($id);

        // dd($state->cities);

        return Inertia::render('Admin/State/Create', [
            'state' => $state,
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


        // $state = State::with('cities')->find($id);


        // dd($state);
    // return Inertia::render('Admin/State/List', [
    //     'state' => $state,
    // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {

            $state = State::with('cities')->find($id);


            // dd($state);
        return Inertia::render('Admin/State/List', [
            'state' => $state,
        ]);
    }
    public function show($id)
    {

            $states = State::with('cities')->find($id);



        return Inertia::render('Admin/State/Show', [
            'states' => $states,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::with('cities')->find($id);

        // dd($state->cities);

        return Inertia::render('Admin/State/Edit', [
            'state' => $state,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
    }
}
