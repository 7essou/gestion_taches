<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
    function show(){
        return view('auth.login');
    }
    function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
           $request->session()->regenerate();
           return redirect()->intended('test'); 
        }
        return back()->withErrors([
            'email'=>'Adresse email invalide!',
        ])->onlyInput('email');
    }
}
