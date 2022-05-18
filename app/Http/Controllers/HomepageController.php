<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        try {
            $products = Product::with(['category' => function($q){
                $q->select('id','name');
            }])->where('status',true)->get(['id','name','image','price','category_id']);
            return view('Website.homepage',compact('products'));
        }catch (\Exception $exception){
            return redirect()->back();
        }

    }

    public function product_details($name){
        try{
            $product = Product::where('name',$name)->first();
            $related_product = Product::whereHas('category',function($q) use($product){
                $q->where('name',$product->category->name);
            })->whereNotIn('name',[$product->name])->get();
            return view('Website.products.details',compact('product','related_product'));
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }

    public function logout(){
        auth('web')->logout();
        return redirect(route('login'));
    }
}
