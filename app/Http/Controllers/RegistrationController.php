<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Modeles\Utilisateur;
use App\Traits\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    use RegisterUser;

    public function show()
    {
        return view('register');
    }

    public function register(RegistrationRequest $requestFields)
    {
        $user = Utilisateur::where('mail', $requestFields->mail)->first();
        if($user != null){
            Session::flash('alert', 'warning');
            Session::flash('warning', 'Mail address already used.');
            return back()->withInput();
        }else {
            $user = $this->registerUser($requestFields);
            Session::flash('alert', 'success');
            Session::flash('success', 'Successfully registered. Try logging in!');
            return redirect('/login');
        }
    }

}
