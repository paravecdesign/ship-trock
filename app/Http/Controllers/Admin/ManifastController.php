<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipments;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManifastController extends Controller
{


    public function index(){
        $shipments = Shipments::all();

        // dd($shipments);
        return Inertia::render('Admin/Manifests/Index',compact('shipments'));
    }

    public function create() {

        return Inertia::render('Admin/Manifests/Create');
    }
}
