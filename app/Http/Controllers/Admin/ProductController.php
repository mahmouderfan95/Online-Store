<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        try{
            $products = Product::get(['id','name','image','price','qty','category_id','is_offer','new_price','description','status']);
            $categories = Category::get(['id','name']);
            return view('Admin-panel.products.index',compact('products','categories'));
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function store(ProductRequest $request){
        try{
            if($request->file('image')){
                $image = $request->file('image');
                $file_name = str_replace(' ','-',$image->getClientOriginalName());
                $request->image->move(public_path('uploads/products/'), $file_name);
                    $productCreate = Product::create([
                        'name' => $request->name,
                        'description' => $request->description,
                        'price' => $request->price,
                        'image' => asset('public/uplodas/products/' . $file_name),
                        'qty' => $request->qty,
                        'is_offer' => $request->is_offer,
                        'new_price' => $request->new_price,
                        'status' => $request->status,
                        'category_id' => $request->category_id
                    ]);
                }
            return redirect()->back()->with(['success' => 'تم اضافة المنتج بنجاح']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request){
        try{
            $product = Product::where('id',$request->product_id)->first();
            if($product){
                if($request->file('image')){
                    $image = $request->file('image');
                    $file_name = $image->getClientOriginalName();
                    $request->image->move(public_path('uploads/products/'), $file_name);
                    $product->image = asset('public/uploads/products/' . $file_name);
                }
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->is_offer = $request->is_offer;
                $product->new_price = $request->new_price;
                $product->qty = $request->qty;
                $product->status = $request->status;
                $product->category_id = $request->category_id;
                $product->save();
                return redirect()->back()->with(['success' => 'تم تحديث بيانات المنتج بنجاح']);
            }
            return redirect()->back()->with(['error' => 'عفوا المنتج غير صحيح']);



        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request){
        try{
            $product = Product::where('id',$request->product_id)->first();
            if($product){
                $product->delete();
                return redirect()->back()->with(['success' => 'تم حذف المنتج بنجاح']);
            }
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }
}
