<?php

namespace App\Http\InertiaControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Products/Index', [
                'products' => Product::paginate(10),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Redirect
     */
    public function store(Request $request): Redirect
    {
        return Redirect::route('products')->with('success', 'Products created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Products $products
     * @return \Inertia\Response
     */
    public function show(Product $products): \Inertia\Response
    {
        return Inertia::render('Products/Show', [
                'products' => $products
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Products $products
     * @return \Inertia\Response
     */
    public function edit(Product $products): \Inertia\Response
    {
        return Inertia::render('Products/Edit', [
                'products' => $products
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Products $products
     * @return Redirect
     */
    public function update(Request $request, Product $products): Redirect
    {
        return Redirect::back()->with('success', 'Products updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Products $products
     * @return Redirect
     */
    public function destroy(Product $products): Redirect
    {
        return Redirect::back()->with('success', 'Products restored.');
    }

    /**
     * Restore the specified resource.
     *
     * @param Products $products
     * @return Redirect
     */
    public function restore(Product $products): Redirect
    {
        $products->restore();

        return Redirect::back()->with('success', 'Products restored.');
    }
}
