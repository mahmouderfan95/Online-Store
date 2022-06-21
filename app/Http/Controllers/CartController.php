<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function add_product(Request $request){
        try{
            // check cart exists
            if($cart = Cart::where('user_id',$request->user_id)->where('status',0)->where('is_open',0)->exists()){
                $cart = Cart::where('user_id',$request->user_id)->where('status',0)->where('is_open',0)->first();
                // check product exists
                if($cartDetails = CartDetails::where('cart_id',$cart->id)->where('is_open',0)->exists()){
                    Alert::error('error message','Product Exists !');
                    return redirect()->back();
                }else{
                    Alert::success('updated and product added');
                    $productCreate = CartDetails::create([
                       'cart_id' => $cart->id,
                       'product_id' => $request->product_id
                    ]);
                    return redirect()->back();
                }
            }else{
                Alert::success('success message','cart created and product added');
                // create cart
                $cartCreate = Cart::create([
                   'user_id' => $request->user_id
                ]);
                // create product
                $cartDetailsCreate = CartDetails::create([
                    'cart_id' => $cartCreate['id'],
                    'product_id' => $request->product_id
                ]);
                return redirect()->back();
            }
        }catch (\Exception $exception){
            Alert::error('error message',$exception->getMessage());
            return redirect()->back();
        }
    }
}
