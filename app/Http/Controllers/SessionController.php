<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    /**
     * Log a user in.
     * @param Request $r
     * @return array
     */
    public function login(Request $r){
        $r->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $auth=auth()->attempt(['email'=>$r->email, 'password'=>$r->password]);
        if ($auth){
            return ['success'=>true];
        }else{
            return ['success'=>false, 'message' => 'E-mail ou mot de passe incorrect.'];
        }
    }

    /**
     * Log a user out.
     */
    public function logout(){
        auth()->logout();
    }
}
