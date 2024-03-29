<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('welcome');
    }

    public function loginProcess(Request $request)
    {
        $credential = $request->only('username', 'password');

        if (Auth::attempt($credential)) {
            if (Auth::user()->role == "admin") {
                return redirect()->intended('administrator');
            }
        } else {
            return redirect()->back()->with("flash", "errorLogin");
        }
    }
}
