<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashbordController extends Controller
{
    public function login(){
        return view('Admin-panel.login');
    }

    public function postLogin(Request $request){
        // make validator
        $validator = Validator::make($request->all(),[
           'email' => 'required',
           'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        }
        // not error
        if(auth('admin')->attempt(['email' => $request->email,'password' => $request->password])){
            return redirect()->route('admin.dashbord');
        }else{
            return redirect()->back()->with(['error' => 'Email or password not correct']);
        }
    }

    public function dashbord(){
        return view('Admin-panel.dashbord');
    }

    public function logout(){
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
