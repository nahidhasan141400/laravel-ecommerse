<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product; 
use App\Models\Flashdeal; 
use App\Models\Productimage;
use App\Models\Checkout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;  
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin_product()
    {
        $category = Category::where('parent_id',NULL)->orderBy('id', 'desc')->get();
        // $sub_category=Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
        $brand = Brand::orderBy('id', 'desc')->get();
        $product=Product::where('product_type','inhouse')->get();
        return view('admin.inhouse_product',compact('category','brand','product'));
    }
    public function get_sub_category($id)
    {
        $sub_category=Category::where('parent_id',$id)->orderBy('id', 'desc')->get();
        $product=Product::where('category_id',$id)->get();
        return response()->json(['success'=>'ok','sub_category'=>$sub_category,'product'=>$product]);
    }
    public function get_product($id)
    {
        $product=Product::where('childcategory_id',$id)->get();
        return response()->json(['success'=>'ok','product'=>$product]);
    }
    public function seller_product()
    {
        $product=Product::where('product_type','seller')->get();
        return view('admin.seller_product',compact('product'));
    }
    // public function admin_product_save_show()
    // {
    //     return view('admin.inhouse_product_save_show');
    // }
    public function admin_product_image_upload(Request $request)
    {
        
        if (!empty($_FILES)) {
            $tempFile = $_FILES['files']['tmp_name'];
            $file_name = $_FILES['files']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            if(filesize($tempFile) > 5000000){
                echo 'FAILED';
                die();
            }
        
            if($ext == 'jpg' || $ext == 'png' || $ext == 'JPG' || $ext == 'PNG'){
                $new_file_name = time().'.'.$ext;
                $targetPath = 'assets/images/product/';  //4
                $targetFile =  $targetPath. $new_file_name;  //5
        
                if ($img = @imagecreatefromstring(file_get_contents($tempFile))) {
                    $upload_result = move_uploaded_file($tempFile,$targetFile); //6
                    echo $new_file_name;
                }else{
                    echo 'FAILED';
                }
            }else{
                echo 'FAILED';
            }
        } 
    }
    public function admin_product_save(Request $request)
    {
        
        $request->validate([
            'flash_deal' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // 'special_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // 'featured_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'uploaded_image_name' => 'required',
            'product_name' => 'required',
            'product_quentity' => 'required',
            'product_category' => 'required',
            'product_child_category' => 'required',
            'product_brand' => 'required',
            'product_meta_tag' => 'required',
            'product_unit_price' => 'required',
            'product_purchase_price' => 'required',
            'tax' => 'required',
            'product_title' => 'required',
            'product_description' => 'required',
            'product_meta_title' => 'required',
            'product_meta_description' => 'required',
            'current_location'=>'required'
          ]);
        $product=new Product();
        $product_category=new Category();
        $product_brand=new Brand();
        $product_image=new Productimage();
        $product->code=request('code');
        $product->name=request('product_name');
        $product->user_id=auth()->user()->id;
        if(auth()->user()->role!=0)
        {
            $product->product_type="inhouse";
        }else{
            $product->product_type="seller";
        }
        $product->quentity=request('product_quentity');
        $product->category_id=request('product_category');
        $product->childcategory_id=request('product_child_category');
        $product->brand_id=request('product_brand');
        $product->current_stock=request('product_quentity');
        $product->tag=request('product_meta_tag');
        $product->unit_price=request('product_unit_price');
        $product->purchase_price=request('product_purchase_price');
        $product->discount=request('discount');
        $product->vat=request('tax');
        $product->shipping_cost=request('shipping_cost');
        $product->title=request('product_title');
        $product->description=request('product_description');
        $product->meta_title=request('product_meta_title');
        $product->meta_description=request('product_meta_description');
        $product->slug = Str::slug($product->title);
   
        if ($request->hasFile('flash_deal')) {
            $logo = $request->file('flash_deal');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('flash_deal')->move(public_path('assets/images/product'), $fileName);
            $product->flash_deal_image=$fileName;
        }

        // if ($request->hasFile('special_product')) {
        //     $logo = $request->file('special_product');
        //     $fileName =time().'.'.$logo->getClientOriginalExtension();
        //     $path=$request->file('special_product')->move(public_path('assets/images/product'), $fileName);
        //     $product->special_product_image=$fileName;
        // }

        // if ($request->hasFile('featured_product')) {
        //     $logo = $request->file('featured_product');
        //     $fileName =time().'.'.$logo->getClientOriginalExtension();
        //     $path=$request->file('featured_product')->move(public_path('assets/images/product'), $fileName);
        //     $product->featured_product_image=$fileName;
        // }

        // $product->video_link=request('video_link');
        $product->added_by=auth()->user()->name;
        $data_choice = [];
        $push="";
        $i=1;
        $content_request="option_content_".$i;
       
        if(!empty($request->option_head) && !empty($request->$content_request))
        {
            foreach($request->option_head as $option_head)
            {
                if($option_head==NULL)
                {
                    
                }else{
                    $content_request="option_content_".$i;
                    foreach($request->$content_request as $option_content)
                    {
                        $push=$push.','.$option_content;
                    }
                    $data_choice[$option_head]=trim($push,',');
                    $push="";
                }
                $i++;
                
            }
            $product->customer_choice=serialize($data_choice);
        }
        $product->current_location=request('current_location');
        $product->finish_alert=request('finish_alert');
        $product->save();
        $product_all_image=request('uploaded_image_name');
        $product_image_count=count($product_all_image);
        for($i=0;$i<$product_image_count;$i++)
        {
        $product_image= Productimage::create([
           'image' => $product_all_image[$i],
            'product_id'=>$product->id,
            ]);
        }
        session()->flash('success','Product uploaded successfully');
        return redirect()->route('admin_product');
        
    }
    
    public function  admin_product_edit_show($id)
    {
        $product = Product::where('id',$id)->first();
        $categorys = Category::where('parent_id',NULL)->orderBy('id', 'desc')->get();
        return view('admin.inhouse_product_edit',compact('product','categorys'));
    }
    public function admin_product_edit(Request $request,$id)
    {
        
        $product = Product::find($id);
        $product->code=request('code');
        $product->name=request('product_name');
        $product->user_id=auth()->user()->id;
        $product->quentity=request('product_quentity')+$product->quentity;
        $product->category_id=request('product_category');
        $product->childcategory_id=request('product_child_category');
        $product->brand_id=request('product_brand');
        if(!empty(request('product_quentity')))
        {
            $product->current_stock=$product->current_stock+request('product_quentity');
        }
        $product->tag=request('product_meta_tag');
        $product->unit_price=request('product_unit_price');
        $product->purchase_price=request('product_purchase_price');
        $product->discount=request('discount');
        $product->vat=request('tax');
        $product->shipping_cost=request('shipping_cost');
        $product->title=request('product_title');
        $product->description=request('product_description');
        $product->meta_title=request('product_meta_title');
        $product->meta_description=request('product_meta_description');
        $product->slug = Str::slug($product->title);
    
        if ($request->hasFile('flash_deal')) {
            $logo = $request->file('flash_deal');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('flash_deal')->move(public_path('assets/images/product'), $fileName);
            $product->flash_deal_image=$fileName;
        }
        // if ($request->hasFile('featured_product')) {
        //     $logo = $request->file('featured_product');
        //     $fileName =time().'.'.$logo->getClientOriginalExtension();
        //     $path=$request->file('featured_product')->move(public_path('assets/images/product'), $fileName);
        //     $product->featured_product_image=$fileName;
        // }

        // $product->video_link=request('video_link');
        $product->added_by=auth()->user()->name;

        $data_choice = [];
        $push="";
        $i=1;
        $content_request="option_content_".$i;
        if(!empty($request->option_head) && !empty($request->$content_request))
        {
            foreach($request->option_head as $option_head)
            {
                if($option_head==NULL)
                {
                    
                }else{
                    $content_request="option_content_".$i;
                    foreach($request->$content_request as $option_content)
                    {
                        $push=$push.','.$option_content;
                    }
                    $data_choice[$option_head]=trim($push,',');
                    $push="";
                    
                }
                $i++;
            }
        }
        
        $product->customer_choice=serialize($data_choice);
        $product->current_location=request('current_location');
        $product->finish_alert=request('finish_alert');
        $product->save();

        $product_all_image=request('uploaded_image_name');
        $product_image_count=count($product_all_image);
        $product_image=Productimage::where('product_id',$product->id)->get();
        for($i=0;$i<$product_image_count;$i++)
        {
            foreach($product_image as $product_image_check)
            {
                if($product_image_check->image==$product_all_image[$i])
                {
                    $image_result=$product_all_image[$i];
// Productimage::where('product_id', $product->id)->update(['image'=>$product_all_image[$i]]);
                }
            }
            if(empty($image_result))
            {
                $product_image= Productimage::create([
                    'image' => $product_all_image[$i],
                     'product_id'=>$product->id,
                     ]);
            }
            $image_result="";
        }
        session()->flash('success','Product updated successfully');
        return redirect()->route('admin_product');
    }
    public function delete_product_image($id)
    {
        $brand=Productimage::where('id',$id)->delete();
        return back();
    }
    public function admin_product_active($id)
    {
        $id=request('id');
        $product = Product::find($id);
        $product->status=1; 
        $product->added_by=auth()->user()->name;   
        $product->save();
        session()->flash('success','Product activated successfully');
        if($product->product_type=="inhouse")
        {
            return response()->json(['url'=>route('admin_product'),'success'=>'ok']);
        }else{
            return response()->json(['url'=>route('seller_product'),'success'=>'ok']);
        }
    }
    public function admin_product_deactive($id)
    {
        $id=request('id');
        $product = Product::find($id);
        $product->status=0; 
        $product->added_by=auth()->user()->name;   
        $product->save();
        session()->flash('success','Product deactivated successfully');
        if($product->product_type=="inhouse")
        {
            return response()->json(['url'=>route('admin_product'),'success'=>'ok']);
        }else{
            return response()->json(['url'=>route('seller_product'),'success'=>'ok']);
        }
    }
    public function admin_product_delete($id)
    {
        $id=request('id');
        $product_check=Product::find($id);
        $product=Product::where('id',$id)->delete();
        session()->flash('success','Product deleted successfully');
        if($product_check->product_type=="inhouse")
        {
            return response()->json(['url'=>route('admin_product'),'success'=>'ok']);
        }else{
            return response()->json(['url'=>route('seller_product'),'success'=>'ok']);
        }
    }
    public function admin_featured_product_deactive($id)
    {
        $id=request('id');
        $product = Product::find($id);
        $product->featured_status=0; 
        $product->added_by=auth()->user()->name;   
        $product->save();
        session()->flash('success','Featured product deactivated successfully');
        if($product->product_type=="inhouse")
        {
            return response()->json(['url'=>route('admin_product'),'success'=>'ok']);
        }else{
            return response()->json(['url'=>route('seller_product'),'success'=>'ok']);
        }
    }
    public function admin_featured_product_active($id)
    {
        $id=request('id');
        $product = Product::find($id);
        $product->featured_status=1; 
        $product->added_by=auth()->user()->name;   
        $product->save();
        session()->flash('success','Featured product activated successfully');
        if($product->product_type=="inhouse")
        {
            return response()->json(['url'=>route('admin_product'),'success'=>'ok']);
        }else{
            return response()->json(['url'=>route('seller_product'),'success'=>'ok']);
        }
    }
    public function flash_show()
    {
        $product=Flashdeal::all();
        return view('admin.flash_deal_show',compact('product'));
    }
    public function flash_deal()
    {
        $products=Product::all();
        return view('admin.flashdeal',compact('products'));
    }

    public function flashdeal_getproduct($id)
    {
        $id=request('id');
        $product=Product::find($id);
        return response()->json(['product'=>$product,'success'=>'ok']);
    }

    public function flash_deal_save(Request $request)
    {
        $time=time();
        $i=0;
        foreach($request->flash_product as $product)
        {
            $flash=new Flashdeal();
            $products_id=$request->flash_product;
            $flash->title=$request->flash_product_title;
            $discounts=$request->discount;
            $flash->start=$request->s_date;
            $flash->end=$request->e_date;
            $flash->code=$time;
            $flash->url=$request->getSchemeAndHttpHost()."/flashdeal"."/".$flash->code;
            
            $flash->product_id=$product;
            $flash->discount=$request->discount[$i];
            $flash->added_by=auth()->user()->name;
       
            $flash->save();
            $i++;
        }
        session()->flash('success','Flashdeal product added successfully');
        return back();
       

    }

    public function flash_product_active($id)
    {
        $id=request('id');
        $product = Flashdeal::find($id);
        $product->status=1; 
        $product->added_by=auth()->user()->name;   
        $product->save();
        session()->flash('success','Flashdeal product activated successfully');
        return response()->json(['url'=>route('flash_show'),'success'=>'ok']);
    }
    public function flash_product_deactive($id)
    {
        $id=request('id');
        $product = Flashdeal::find($id);
        $product->status=0; 
        $product->added_by=auth()->user()->name;   
        $product->save();
        session()->flash('success','Flashdeal product deactivated successfully');
        return response()->json(['url'=>route('flash_show'),'success'=>'ok']);
    }
    public function flash_product_delete($id)
    {
        $id=request('id');
        $product = Flashdeal::find($id);
        if(!empty($product))
        {
            $product=Flashdeal::where('id',$id)->delete();
            session()->flash('success','Flashdeal product deleted successfully');
            return response()->json(['url'=>route('flash_show'),'success'=>'ok']);
        }else{
            return back();
        }
    }
    public function flash_product_edit($id)
    {
        $flashdeal=Flashdeal::where('code',$id)->first();
        $flashdeals=Flashdeal::where('code',$id)->get();
        if(!empty($flashdeal))
        {
            return view('admin.flashdeal_edit',compact('flashdeal','flashdeals'));
        }else{
            return back();
        }
        
    }
    public function flash_product_edit_save(Request $request,$id)
    {
       
        $i=0;
        $flash=Flashdeal::where('code',$id)->get();
        if(!empty($flash))
        {
            foreach($request->flash_product_name as $product)
            {
                $flash=Flashdeal::where('product_id',$product)->where('code',$id)->first();
                $flash->title=$request->flash_product_title;
                $flash->product_id=$product;
                $flash->discount=$request->discount[$i];
                $flash->added_by=auth()->user()->name;
    
                $flash->start=$request->s_date;
                $flash->end=$request->e_date;
                $flash->save();
                $i++;
            }
            
            session()->flash('success','Flashdeal product edited successfully');
            return redirect()->route('flash_show');
        }else{
            return redirect()->route('flash_show');
        }
        
    }

    public function pick_up_order()
    {
        $sales=Checkout::all();
        return view('admin.pick_up_order',compact('sales'));
    }
}
