<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ConfirmCart;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
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
                if($cartDetails = CartDetails::where('cart_id',$cart->id)->where('is_open',0)
                    ->where('product_id',$request->product_id)
                    ->exists()){
                    Alert::error('error message','Product Exists !');
                    return redirect()->back();
                }else{
                    Alert::success('success msg','updated and product added');
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

    public function getProductFromCart(){
        try{
            $cart = Cart::where('user_id',auth('web')->user()->id)
                ->where('is_open',0)
                ->first();
            if($cart){
                $details = CartDetails::where('cart_id',$cart->id)
                    ->where('is_open',0)
                    ->get();
                return view('Website.cart.index',compact('cart','details'));
            }
            return view('Website.cart.index',compact('cart'));
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function deleteProductFromCart($cart_id,$product_id){
        try{
            // delete product from cart
            Alert::success('product delete','product deleted success');
            $product = CartDetails::where('cart_id',$cart_id)->where('product_id',$product_id)->first();
            if($product){
                $product->delete();
                return redirect()->back();
            }else{
                Alert::error('error msg','product not found');
                return redirect()->back();
            }
        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function confirmCart(ConfirmCart $request){
        try{
            // confirm cart
            $request->validated();
            Alert::success('success msg','order created');
            // loop for products
            if($request->products){
                foreach ($request->products as $detail){
                    $product = Product::where('id',$detail['product_id'])->first();
                    // calc product price
                    if($product->is_offer == null){
                        $product_price = $product->price;
                    }else{
                        $product_price = $product->new_price;
                    }
                    // update qty and total price for cart details
                    $cart_details = CartDetails::where('cart_id',$request->cart_id)
                        ->where('product_id',$detail['product_id'])
                        ->first();
                    $cart_details->qty = $detail['qty'];
                    $cart_details->total_price = $product_price * $detail['qty'];
                    $cart_details->save();
                }
            }

            // create new order
            $order_create = Order::create([
                'user_id' => $request->user_id,
                'cart_id' => $request->cart_id,
                'total_price' => 0,
                'status' => 'pending'
            ]);
            // update status and is_open for cart
            $cart = Cart::where('user_id',$request->user_id)->where('is_open',0)->first();
            $cart->is_open = true;
            $cart->status = true;
            $cart->save();
            // create order details
            $order_details = OrderDetails::create([
               'order_id' => $order_create['id'],
                'cart_id' => $cart->id
            ]);
            // update is_open for details
            $details = CartDetails::where('cart_id',$cart->id)->get();
            foreach ($details as $cart_detail){
                $cart_detail->is_open = true;
                $cart_detail->save();
            }
            // sum total price
            $order_total_price = $details->sum('total_price');
            // update total price from order
            $order = Order::where('id',$order_create['id'])->first();
            $order->total_price = $order_total_price;
            $order->save();
            return redirect()->back();

        }catch (\Exception $exception){
            Alert::error('error msg',$exception->getMessage());
            return redirect()->back();
        }
    }
}
