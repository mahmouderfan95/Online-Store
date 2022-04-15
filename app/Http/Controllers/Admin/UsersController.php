<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller

{
    public function index(){
        try{
            $users = User::get(['id','name','email','phone_number','address','password']);
            return view('Admin-panel.users.index',compact('users'));
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function store(UserRequest $request){
        try{
            $request->validated();
            $userCreate = User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => bcrypt($request->password),
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]);
            return redirect()->back()->with(['success' => 'تم اضافة المستخدم بنجاح']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request){
        try{
            $user = User::where('id',$request->user_id)->first();
            if($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->address = $request->address;
                // update password
                if($request->password == null){
                    $user->password = $request->old_password;
                }else{
                    $user->password = bcrypt($request->password);
                }

                $user->save();
                return redirect()->back()->with(['success' => 'تم تحديث بيانات المستخدم بنجاح']);
            }
        }catch (\Exception $exception){

        }
    }

    public function destroy(Request $request){
        try{
            $user = User::where('id',$request->user_id)->first();
            if($user){
                $user->delete();
                return redirect()->back()->with(['success' => 'تم حذف المستخدم بنجاح']);
            }
        }catch (\Exception $exception){

        }
    }
}
