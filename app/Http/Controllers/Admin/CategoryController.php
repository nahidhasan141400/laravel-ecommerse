<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Category; 
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin_product_category()
    {
        $category = Category::orderBy('id', 'desc')->get();
        $sub_category=Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
        return view('admin.category',compact('category','sub_category'));
    }
    public function admin_product_category_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
    
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first(),'val_error'=>"ok"]);
        }else if ($request->hasFile('category_logo')) {
            $category_logo = $request->file('category_logo');
            $fileName =time().'.'.$category_logo->getClientOriginalExtension();
            $path=$request->file('category_logo')->move(public_path('assets/images/category'), $fileName);
            $category=new Category();
            $category->name=request('first_category');
            $category->parent_id=request('second_category');
            $category->first_category_slug=Str::slug($category->name);
            if ($category->parent_id == 0) {
                $category->parent_id = NULL;
            }
            $category->logo=$fileName;
            $category->title=request('category_title');
            $category->description=request('category_description'); 
            $category->added_by=auth()->user()->name;   
            $category->save();
            session()->flash('success','Category added successfully');
            return response()->json(['url'=>route('admin_product_category'),'success'=>'ok']);
          
        }
    }

    public function admin_product_category_edit_save($id,Request $request)
    {
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('logo')->move(public_path('assets/images/category'), $fileName);
            $category = Category::find($id);
            $category->name=request('category_name');
            $category->parent_id=request('parent_id');
            if ($category->parent_id == 0) {
                $category->parent_id = NULL;
            }
            $category->logo=$fileName;
            $category->title=request('title');
            $category->description=request('description'); 
            $category->added_by=auth()->user()->name;   
            $category->save();
            session()->flash('success','Category updated successfully');
            return response()->json(['url'=>route('admin_product_category'),'success'=>'ok']);
          
        }else if(!$request->hasFile('logo')){
            $category = Category::find($id);
            $category->name=request('category_name');
            $category->parent_id=request('parent_id');
            if ($category->parent_id == 0) {
                $category->parent_id = NULL;
            }
            $category->title=request('title');
            $category->description=request('description'); 
            $category->added_by=auth()->user()->name;   
            $category->save();
            session()->flash('success','Category updated successfully');
            return response()->json(['url'=>route('admin_product_category'),'success'=>'ok']);
        }
    }


    public function admin_product_category_active_show($id)
    {
        $id=request('id');
        $category = Category::find($id);
        $category->status=1; 
        $category->added_by=auth()->user()->name;   
        $category->save();
        session()->flash('success','Category activated successfully');
        return response()->json(['url'=>route('admin_product_category'),'success'=>'ok']);
    }
    public function admin_product_category_deactive_show($id)
    {
        $id=request('id');
        $category = Category::find($id);
        $category->status=0; 
        $category->added_by=auth()->user()->name;   
        $category->save();
        session()->flash('success','Category deactivated successfully');
        return response()->json(['url'=>route('admin_product_category'),'success'=>'ok']);
    }
    public function admin_product_category_delete_show($id)
    {
        $id=request('id');
        $subcategorys=Category::where('parent_id',$id)->get();
        foreach($subcategorys as $subcategory)
        {
            $update_category=Category::where('parent_id',$id)->first();
            $update_category->parent_id=NULL;
            $update_category->save();
        }
        $category=Category::where('id',$id)->delete();
        session()->flash('success','Category deleted successfully');
        return response()->json(['url'=>route('admin_product_category'),'success'=>'ok']);
    }
}
