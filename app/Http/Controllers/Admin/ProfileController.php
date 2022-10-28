<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Inertia\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
// use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Auth\AdminLoginRequest;

class ProfileController extends Controller
{
    public function show()
    {

        return Inertia::render('Auth/Profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user('admin')->update(['password' => Hash::make($request->password)]);
        }

        auth()->user('admin')->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }

    public function check(AdminLoginRequest $request)
    {
        // dd($request);

        // if(Auth::guard('admin')->attempt(['']))


        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));

    }

    public function login()
    {
        return Inertia::render('Admin/Auth/Login');
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
