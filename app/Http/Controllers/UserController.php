<?php

namespace App\Http\Controllers;

use App\Http\Requests\Website\UpdateProfile;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function editProfile($id){
        try{
            $user = User::where('id',$id)->first();
            return view('Website.users.profile',compact('user'));
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }

    public function updateProfile(UpdateProfile $request){
        try{
            $user = User::where('id',$request->id)->first();
            if($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->address = $request->address;
                $user->phone_number = $request->phone_number;
                if($request->password !== null){
                    $user->password = bcrypt($request->password);
                }
                $user->save();
                return redirect()->back();
            }
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }
}
