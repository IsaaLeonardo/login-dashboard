<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home () {
        return view("login");
    }

    public function login () {
        $credentials = request()->only('email', 'password');
        return $credentials;
    }
}
