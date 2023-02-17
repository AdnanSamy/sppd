<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function index(Request $request){
        return view('login');
    }

    public function login_proccess(Request $request)
    {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );

        $kredensil = $request->only('email', 'password');

        if (Auth::attempt($kredensil)) {
            return redirect()->intended('/');
        }

        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
    }
}
