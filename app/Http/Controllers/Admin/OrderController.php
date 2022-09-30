<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        try{
            $orders = Order::orderBy('id','desc')->get();
            return view('Admin-panel.orders.index',compact('orders'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function update(Request $request){
        try{
            Alert::success('success msg','تم تغير حالة الطلب');
             $order = Order::where('id',$request->order_id)->first();
             if($order){
                 $order->status = $request->status;
                 $order->save();
                 return redirect()->back();
             }
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
    public function getDetails($id){
        try{
            $details = OrderDetails::where('order_id',$id)->get();
            return view('Admin-panel.orders.details',compact('details'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
