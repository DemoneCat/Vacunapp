<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request){
        return view('auth.index');
    }
    public function register(Request $request){

    }
    public function login(Request $request){

    }
}
