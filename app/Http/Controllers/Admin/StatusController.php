<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return Inertia::render('Admin/Status/Index', [
            'statuses' => Status::paginate(10)
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
            'name' => 'required|string|max:255|unique:statuses',
            'percentage' => 'required|string|max:255|unique:statuses',
        ]);

        $status = Status::create([
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);


        return Redirect::route('admin.setting.statuses.index')->with('success', 'A New Progression Status Successfully Added.');
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


        return Inertia::render('Admin/Status/Edit', [
            'statuses' => Status::paginate(),
            'status' => status::find($id),
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
        $status = Status::find($id);



        $data = $request->validate([
            'name' => ['required', 'unique:statuses,name,'.$status->id],
            'percentage' => ['required', 'unique:statuses,percentage,'.$status->id],
        ]);

        $status->update($data);


        return Redirect::route('admin.setting.statuses.index')->with('success', 'The Progression Status Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();

        return Redirect::route('admin.setting.statuses.index')->with('error', 'The Progression Status deleted.');
    }
}
