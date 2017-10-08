<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function index(){
        return User::all();
    }

    public function oneUser($id){
        return User::where('id', $id)->get();
    }

    public function login(Request $r){
        $r->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $auth=auth()->attempt(['email'=>$r->email, 'password'=>$r->password]);
        if ($auth){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }

    public function logout(){
        auth()->logout();
    }
}
