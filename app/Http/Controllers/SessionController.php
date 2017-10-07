<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function index(){
        return response()->json(User::all());
    }

    public function oneUser($id){
        return response()->json(User::where('id', $id)->get());
    }

    public function oneUserId($id){
        return response()->json(User::where('id', $id)->get());
    }

    public function login(Request $r){
        $r->validate([
            'username' => 'email|required',
            'password' => 'required'
        ]);
        $auth=auth()->attempt(['email'=>$r->username, 'password'=>$r->password]);
        if ($auth){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }

    public function logout(){

    }
}
