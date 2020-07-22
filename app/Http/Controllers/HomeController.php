<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        $communities = $user->communautes;
        //dd($communities);
        return view('home', compact('user', 'communities'));
    }
}
