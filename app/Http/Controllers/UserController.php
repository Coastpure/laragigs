<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show Register/Register Form
    public function register()
    {
        return view('users.register');
    }
}
