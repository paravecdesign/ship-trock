<?php

namespace App\Http\InertiaControllers;

use App\Models\Duty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Duties/Index', [
                'duties' => Duty::paginate(10),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Duties/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Redirect
     */
    public function store(Request $request): Redirect
    {
        return Redirect::route('duties')->with('success', 'Duty created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Duty $duty
     * @return \Inertia\Response
     */
    public function show(Duty $duty): \Inertia\Response
    {
        return Inertia::render('Duties/Show', [
                'duty' => $duty
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Duty $duty
     * @return \Inertia\Response
     */
    public function edit(Duty $duty): \Inertia\Response
    {
        return Inertia::render('Duties/Edit', [
                'duty' => $duty
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Duty $duty
     * @return Redirect
     */
    public function update(Request $request, Duty $duty): Redirect
    {
        return Redirect::back()->with('success', 'Duty updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Duty $duty
     * @return Redirect
     */
    public function destroy(Duty $duty): Redirect
    {
        return Redirect::back()->with('success', 'Duty restored.');
    }

    /**
     * Restore the specified resource.
     *
     * @param Duty $duty
     * @return Redirect
     */
    public function restore(Duty $duty): Redirect
    {
        $duty->restore();

        return Redirect::back()->with('success', 'Duty restored.');
    }
}
