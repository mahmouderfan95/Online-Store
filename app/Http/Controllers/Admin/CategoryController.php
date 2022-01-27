<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::get(['id','name','description','parent']);
        return view('Admin-panel.categories.index',compact('categories'));
    }

    public function store(CategoryRequest $request){
        try{
//            return $request;
            $request->validated();
            $categoryCreate = Category::create([
               'name' => $request->name,
               'description' => $request->description,
               'parent' => $request->parent
            ]);

            return redirect()->back()->with(['success' => 'تم انشاء القسم بنجاح']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request){
        try{
            $category = Category::where('id',$request->cat_id)->first();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect()->back()->with(['success' => 'تم تحديث بيانات القسم بنجاح']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request){
        try{
            $category = Category::where('id',$request->cat_id)->first();
            $category->delete();
            return redirect()->back()->with(['success' => 'تم حذف القسم بنجاح']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }
}
