<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserContoller extends Controller
{
    function auth(Request $request){
       if(User::where('email',$request->email)->where('password',$request->password)->get()){
          return redirect('/test');
       }
       else{
        return back()->withInput();
       }
    }
}
