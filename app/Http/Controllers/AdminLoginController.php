<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // Here will be validation
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // Here will be logic and process
        if ( Auth::guard('admin')->attempt( $data,$request->remember) ) {
            return redirect()->intended(route('admin.dashboard'));
        }
        // Here will be return 
        return redirect()->back()->withInput( $request->only('email','remember'));
        // dd($request->all());
    }
}
