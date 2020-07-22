<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Traits\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $user = $this->registerUser($requestFields);
        return redirect('/login');
    }

}
