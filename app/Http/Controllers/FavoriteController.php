<?php

namespace App\Http\Controllers;

use App\Http\Requests\Website\Favorites\AddProduct;
use App\Models\Favorite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FavoriteController extends Controller
{
    public function add_product(AddProduct $request){
        try{
            $fav = Favorite::where('user_id',$request->user_id)->where('product_id',$request->product_id)->exists();
            if($fav){
                Alert::success('success message','Product deleted');
                $del_product = Favorite::where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
                $del_product->delete();
                return redirect()->back();
            }else{
                Alert::success('success message','Product Added');
                $favCreate = Favorite::create([
                   'user_id' => $request->user_id,
                   'product_id' => $request->product_id
                ]);
                return redirect()->back();
            }
        }catch (\Exception $exception){
            Alert::error('error message',$exception->getMessage());
            return redirect()->back();
        }
    }

    public function get_products(Request $request){
        try{
            $favs = Favorite::where('user_id',auth('web')->user()->id)->get();
            return view('Website.products.favories_products',compact('favs'));
        }catch (\Exception $exception){
            Alert::error('error message',$exception->getMessage());
            return redirect()->back();
        }
    }

}
