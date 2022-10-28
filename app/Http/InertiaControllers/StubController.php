<?php

namespace App\Http\InertiaControllers;

use App\Models\Stub;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Stubs/Index', [
                'stubs' => Stub::paginate(10),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Stubs/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Redirect
     */
    public function store(Request $request): Redirect
    {
        return Redirect::route('stubs')->with('success', 'Stub created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Stub $stub
     * @return \Inertia\Response
     */
    public function show(Stub $stub): \Inertia\Response
    {
        return Inertia::render('Stubs/Show', [
                'stub' => $stub
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Stub $stub
     * @return \Inertia\Response
     */
    public function edit(Stub $stub): \Inertia\Response
    {
        return Inertia::render('Stubs/Edit', [
                'stub' => $stub
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Stub $stub
     * @return Redirect
     */
    public function update(Request $request, Stub $stub): Redirect
    {
        return Redirect::back()->with('success', 'Stub updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stub $stub
     * @return Redirect
     */
    public function destroy(Stub $stub): Redirect
    {
        return Redirect::back()->with('success', 'Stub restored.');
    }

    /**
     * Restore the specified resource.
     *
     * @param Stub $stub
     * @return Redirect
     */
    public function restore(Stub $stub): Redirect
    {
        $stub->restore();

        return Redirect::back()->with('success', 'Stub restored.');
    }
}
