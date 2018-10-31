<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    //
    public function signin(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->has('remember'))) {
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('fail', 'Authentication Failed');
    }
}
