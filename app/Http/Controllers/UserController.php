<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Measurement;

class UserController extends Controller
{
    public function home () {
        return view("login");
    }

    public function login () {
        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('dashboard');
        }

        return redirect('/');
    }

    public function showDashboard() {
        return view('dashboard');
    }

    public function loadData() {
        $measuraments = Measurement::orderBy('id', 'desc')->take(50)->get()->toArray();
        return response()->json($measuraments);
    }
}
