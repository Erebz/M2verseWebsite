<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Modeles\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function authenticate(LoginRequest $requestFields)
    {
        //$attributes = $requestFields->only(['mail', 'password']);

        $user = Utilisateur::where('mail', $requestFields->mail)->get();
        if($user != null){
            auth()->guard('web')->login($user);
            return redirect()->route('acceuil');
        }else{
            return redirect()->route('login')->with('info', 'Failed to connect.');
        }


        /*
        if (Auth::attempt($attributes)) {
            return redirect()->route('acceuil');
        }else{
            return redirect()->route('login')->with('info', 'Failed to connect.');
        }
        */
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return back();
    }

}
