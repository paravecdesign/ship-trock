<?php

namespace App\Http\Controllers\Customers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(){
        $customer = User::with('shipments')->find(auth()->id());
        $status = Status::withCount('shipments')->get();
// dd($customer);
        return Inertia::render('Customers/Dashboard',[
            'customer' => $customer,
            'packages' => $customer->shipments()->paginate(20),
            'shipmentstatus' => $status,
        ]);
    }
}
