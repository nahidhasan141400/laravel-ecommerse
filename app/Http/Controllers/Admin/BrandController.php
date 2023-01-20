<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Brand; 
class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin_product_brand()
    {
        $brands=Brand::all();
        return view('admin.brand',compact('brands'));
    }
    public function admin_product_brand_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
    
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first(),'val_error'=>"ok"]);
        }else if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('logo')->move(public_path('assets/images/brand'), $fileName);
            $brand=new Brand();
            $brand->name=request('name');
            $brand->logo=$fileName;
            $brand->title=request('title');
            $brand->description=request('description'); 
            $brand->added_by=auth()->user()->name;   
            $brand->save();
            session()->flash('success','Brand added successfully');
            return response()->json(['url'=>route('admin_product_brand'),'success'=>'ok']);
          
        }
    }
    public function admin_product_brand_edit_save($id,Request $request)
    {
        // if($request->hasFile('logo'))
        // {
        //     $validator = Validator::make($request->all(), [
        //         'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //       ]);
        
        //     if ($validator->fails()) {
        //         return response()->json(['error'=>$validator->errors()->first(),'val_error'=>"ok"]);
        //     }
        // }
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('logo')->move(public_path('assets/images/brand'), $fileName);
            $brand = Brand::find($id);
            $brand->name=request('name');
            $brand->logo=$fileName;
            $brand->title=request('title');
            $brand->description=request('description'); 
            $brand->added_by=auth()->user()->name;   
            $brand->save();
            session()->flash('success','Brand added successfully');
            return response()->json(['url'=>route('admin_product_brand'),'success'=>'ok']);
          
        }else if(!$request->hasFile('logo')){
            $brand = Brand::find($id);
            $brand->name=request('name');
            $brand->title=request('title');
            $brand->description=request('description'); 
            $brand->added_by=auth()->user()->name;   
            $brand->save();
            session()->flash('success','Brand added successfully');
            return response()->json(['url'=>route('admin_product_brand'),'success'=>'ok']);
        }
    }
    public function admin_product_brand_delete_show()
    {
        $id=request('id');
        $brand=Brand::where('id',$id)->delete();
        session()->flash('success','Brand deleted successfully');
        return response()->json(['url'=>route('admin_product_brand'),'success'=>'ok']);
    }
    public function admin_product_brand_active_show()
    {
        $id=request('id');
        $brand = Brand::find($id);
        $brand->status=1; 
        $brand->added_by=auth()->user()->name;   
        $brand->save();
        session()->flash('success','Brand deactivated successfully');
        return response()->json(['url'=>route('admin_product_brand'),'success'=>'ok']);
    }
    public function admin_product_brand_deactive_show()
    {
        $id=request('id');
        $brand = Brand::find($id);
        $brand->status=0; 
        $brand->added_by=auth()->user()->name;   
        $brand->save();
        session()->flash('success','Brand activated successfully');
        return response()->json(['url'=>route('admin_product_brand'),'success'=>'ok']);
    }
}
