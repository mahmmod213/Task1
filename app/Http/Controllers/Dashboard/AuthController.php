<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showForm(){
        return view('dashboard.auth.login');
    }

    public function login(AdminLoginRequest $request){
        $remember = $request->has('remember');
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$remember)){
            return redirect()->route('admin.dashboard');
        }
        //toastr()->error('Email Or Password Are Not Correct');
        return redirect()->back()->with('error','Email Or Password Are Not Correct');
    }


    public function showDashboard(){
        return view('dashboard.dashboard');
    }

    public function logout(Request $request){
        \auth()->guard('admin')->logout();
        return redirect()->route('admin.show.form')->with('success','Logout Successfully');
    }
}
