<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        $products = Product::with(['category' => function($q){
            $q->select('id','name');
        }])->where('status',true)->get(['id','name','image','price','category_id']);
        return view('Website.homepage',compact('products'));
    }

    public function product_details($name){
        try{
            $product = Product::where('name',$name)->first();
            return view('Website.products.details',compact('product'));
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }
}
