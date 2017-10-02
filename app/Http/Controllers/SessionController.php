<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('login');
    }

    public function login(Request $r){
        $r->validate([
            'username' => 'email|required',
            'password' => 'required'
        ]);
        auth()->attempt(['email'=>$r->username, 'password'=>$r->password]);
    }

    public function logout(){

    }
}
