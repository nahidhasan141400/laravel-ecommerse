<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product; 
use App\Models\Productimage;
use App\Models\Blog;
use App\Models\Subscribe;
use App\Models\Compare;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Seosetting;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Couponused;
use App\Models\Flashdeal;
use App\Models\Policy;
use Carbon\Carbon;
use Session;
class ProductController extends Controller
{
    public function home()
    {
        $category = Category::where('status',1)->orderBy('id', 'desc')->get();
        $sub_category=Category::where('status',1)->orderBy('name', 'desc')->where('parent_id', NULL)->get();
        $brand = Brand::where('status',1)->orderBy('id', 'desc')->get();

        $product=Product::where('status',1)->orderBy('id', 'desc')->get();
        // $special_products=Product::where('status',1)
        //                   ->orderBy('id', 'desc')
        //                   ->orderBy('rating', 'desc')
        //                   ->get();
        // $best_sell_product=Product::where('status',1)
        //                    ->orderBy('id', 'desc')
        //                    ->orderBy('num_of_sale', 'desc')
        //                    ->orderBy('rating', 'desc')
        //                    ->get();
        // $product_featured=Product::where('featured_status',1)
        //                            ->where('featured_status',1)
        //                            ->orderBy('id', 'desc')
        //                            ->orderBy('rating', 'desc')
        //                            ->get();
        $blog=Blog::orderBy('id', 'desc')->get();

        $sliders=Slider::where('status',1)->get();
        $banners1=Banner::where('status',1)->where('position',1)->limit(3)->orderBy('id','desc')->get();
        $banners2=Banner::where('status',1)->where('position',2)->limit(2)->orderBy('id','desc')->get();
        $seo=Seosetting::orderBy('id','desc')->first();

        return view('supplier.frontend.home',compact(
            'category',
            'sub_category',
            'brand','product',
            // 'special_products',
            // 'best_sell_product',
            // 'product_featured',
            'blog','sliders',
            'banners1',
            'banners2',
            'seo'
        ));
    }

    public function product_view($id,$slug)
    {
        $product=Product::where('status',1)->where('id',$id)->first();
        if(empty($product))
        {
            session()->flash('success','Product not found !');
            return redirect()->route('home');
        }
        $seo=Product::where('id',$id)->select('tag','meta_description')->first();
        $related_product=Product::where('status',1)->where('category_id',$product->category_id)->limit(4)->get();
       
        $sale=Cart::where('user_id', Auth::guard('supplier')->id())
                        ->where('product_id',$id)
                        ->where('purchase_id','1')
                    ->orWhere('ip',request()->ip())
                        ->where('product_id',$id)
                        ->where('purchase_id','1')
                    ->first();
        
        return view('supplier.frontend.product',compact('product','related_product','seo','sale'));

    }
    public function main_category($id,$slug,Request $request)
    {
        $current_page=$request['page'];
        $query=$id;
        $value=1;
        $seo=Category::find($id);
        $category=Category::where('status',1)
                         ->where('parent_id',$id)
                         ->orderBy('id', 'desc')
                         ->paginate(9);
        if(empty($category))
        {
            session()->flash('success','Product not found !');
            return redirect()->route('home');
        }
        return view('supplier.frontend.category',compact('category','query','value','seo','current_page'));
    }
    public function sub_category($id,$slug,$slugs,Request $request)
    {
        $current_page=$request['page'];
        $query=$id;
        $value=1;
        $seo=Category::find($id);
        $childcategory=Product::where('status',1)
                                ->where('childcategory_id',$id)
                                ->orderBy('id', 'desc')
                                ->orderBy('num_of_sale', 'desc')
                                ->orderBy('rating', 'desc')
                                ->paginate(9);
        if(empty($childcategory))
        {
            session()->flash('success','Product not found !');
            return redirect()->route('home');
        }
        return view('supplier.frontend.childcategory',compact('childcategory','query','value','seo','current_page'));
    }
    public function brand($id,$name,Request $request)
    {
        $current_page=$request['page'];
        $query=$id;
        $value=1;
        $seo=Brand::find($id);
        $brand=Product::where('status',1)
               ->where('brand_id',$id)
               ->orderBy('id', 'desc')
               ->orderBy('num_of_sale', 'desc')
               ->orderBy('rating', 'desc')
               ->paginate(2);
        if(empty($brand))
        {
            session()->flash('success','Product not found !');
            return redirect()->route('home');
        }
        return view('supplier.frontend.brand',compact('brand','query','value','seo','current_page'));
    }

    public function category_sort($query,Request $request)
    {
        $current_page=$request['page'];
        $value=request('filter');
        if( $value==1)
        {  
            $search=Product::where('status',1)->where('category_id', 'LIKE', "%{$query}%")
                        ->orderBy('name','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==2){
            $search=Product::where('status',1)->where('category_id', 'LIKE', "%{$query}%")
                        ->orderBy('name','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==3){
            $search=Product::where('status',1)->where('category_id', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==4){
            $search=Product::where('status',1)->where('category_id', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==5){
            $search=Product::where('status',1)->where('category_id', 'LIKE', "%{$query}%")
                        ->orderBy('rating','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }elseif($value==6){
            $search=Product::where('status',1)->where('category_id', 'LIKE', "%{$query}%")
                        ->orderBy('rating','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }else{
            $search=Product::where('status',1)
                    ->where('category_id', 'LIKE', "%{$query}%")
                    ->orderBy('id', 'desc')
                    ->orderBy('num_of_sale', 'desc')
                    ->orderBy('rating', 'desc')
                    ->paginate(2);
        }
     
        return view('supplier.frontend.category_sort',compact('search','query','value','current_page'));
    }

    public function sub_category_sort($query,Request $request)
    {
        $current_page=$request['page'];
        $value=request('filter');
        if( $value==1)
        {  
            $search=Product::where('status',1)->where('childcategory_id', 'LIKE', "%{$query}%")
                        ->orderBy('name','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==2){
            $search=Product::where('status',1)->where('childcategory_id', 'LIKE', "%{$query}%")
                        ->orderBy('name','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==3){
            $search=Product::where('status',1)->where('childcategory_id', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==4){
            $search=Product::where('status',1)->where('childcategory_id', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==5){
            $search=Product::where('status',1)->where('childcategory_id', 'LIKE', "%{$query}%")
                        ->orderBy('rating','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }elseif($value==6){
            $search=Product::where('status',1)->where('childcategory_id', 'LIKE', "%{$query}%")
                        ->orderBy('rating','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }else{
            $search=Product::where('status',1)->where('childcategory_id', 'LIKE', "%{$query}%")
                    ->orderBy('id', 'desc')
                    ->orderBy('num_of_sale', 'desc')
                    ->orderBy('rating', 'desc')
                    ->paginate(2);
        }
     
        return view('supplier.frontend.sub_category_sort',compact('search','query','value','current_page'));
    }
    public function brand_sort($query,Request $request)
    {

        $current_page=$request['page'];
        $value=request('filter');
        if( $value==1)
        {  
            $search=Product::where('status',1)->where('brand_id', 'LIKE', "%{$query}%")
                        ->orderBy('name','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==2){
            $search=Product::where('status',1)->where('brand_id', 'LIKE', "%{$query}%")
                        ->orderBy('name','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==3){
            $search=Product::where('status',1)->where('brand_id', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==4){
            $search=Product::where('status',1)->where('brand_id', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==5){
            $search=Product::where('status',1)->where('brand_id', 'LIKE', "%{$query}%")
                        ->orderBy('rating','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }elseif($value==6){
            $search=Product::where('status',1)->where('brand_id', 'LIKE', "%{$query}%")
                        ->orderBy('rating','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }else{
            $search=Product::where('status',1)->where('brand_id', 'LIKE', "%{$query}%")
                   ->orderBy('id', 'desc')
                   ->orderBy('num_of_sale', 'desc')
                   ->orderBy('rating', 'desc')
                   ->paginate(2);
        }
     
        return view('supplier.frontend.brand_sort',compact('search','query','value','current_page'));
    }

    public function search(Request $request)
    {
        $current_page=$request['page'];
        
        $query=request('search');
        if(!empty($query))
        {
            session()->put('value', $query);
        }
        if(empty($query))
        {
            $query =session()->get('value');
        }
        // dd( $query);
        $value=1;
        $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                ->orderBy('id', 'desc')
                ->orderBy('num_of_sale', 'desc')
                ->orderBy('rating', 'desc')
                ->paginate(2);
        return view('supplier.frontend.search',compact('search','query','value','current_page'));
    }
    public function sort($query,Request $request)
    {
        $current_page=$request['page'];
        $value=request('filter');
        if( $value==1)
        {  
            $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                        ->orderBy('name','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==2){
            $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                        ->orderBy('name','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==3){
            $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==4){
            $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                        ->orderBy('unit_price','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->orderBy('rating', 'desc')
                        ->paginate(2);
        }elseif($value==5){
            $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                        ->orderBy('rating','asc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }elseif($value==6){
            $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                        ->orderBy('rating','desc')
                        ->orderBy('id', 'desc')
                        ->orderBy('num_of_sale', 'desc')
                        ->paginate(2);
        }else{
            $search=Product::where('status',1)->where('title', 'LIKE', "%{$query}%")
                    ->orderBy('id', 'desc')
                    ->orderBy('num_of_sale', 'desc')
                    ->orderBy('rating', 'desc')
                    ->paginate(2);
        }
     
        return view('supplier.frontend.search',compact('search','query','value','current_page'));
    }

    public function subscribe()
    {
        $email=request('email');
        $subscribe=new Subscribe();
        $subscribe->email=$email;
        $subscribe->save();
        session()->flash('success','You have subscribed successfully');
        return back();
    }

    public function view_compare()
    {
        return view('supplier.frontend.comparison');
    }
    public function compare($id,Request $request)
    {
         if(Auth::guard('supplier')->check())
            {
                $compare=Compare::where('product_id',$id)
                           ->where('user_id',Auth::guard('supplier')->id())
                           ->first();     
            }else{
                $compare=Compare::where('ip',request()->ip())
                           ->where('product_id',$id)
                           ->first();
            }
          
            if(is_null($compare)){
                $compare=new Compare();
                {
                    $compare->user_id=Auth::guard('supplier')->id();
                }
                $product_image=Productimage::where('product_id',$id)->select('image')->first();
                $compare->image=$product_image->image;
                $compare->product_id=$id;
                $compare->ip=request()->ip();
                $compare->save();
            }
            return json_encode(['total_items'=>Compare::totalCompareIteams(),'status'=>'success','message'=>'It had been added in compare list',]);
    }

    public function coupon_verify(Request $request)
    {
        $coupon_code=$request->coupon;
        $check=Coupon::where('code', $coupon_code)
                     ->where('start_date','<=',Carbon::now()->toDateString()) 
                     ->where('end_date','>=',Carbon::now()->toDateString())  
                     ->first();
        if(!empty($check))
        {
            
            session()->flash('success','Coupon added successfully');
            return redirect()->route('checkout')->with('check',$check);
        }
        session()->flash('success','Coupon code expired');  
        return redirect()->route('checkout');
    }

    public function flashdeal($value)
    {
        $time=Flashdeal::where('code',$value)->select('end','title')->first();
        if(!empty($time))
        {
            $flashdeal=Flashdeal::where('status',1)
                       ->where('start','<=',Carbon::now()->toDateString()) 
                       ->where('end','>=',$time->end)  
                       ->where('code',$value)->get();

            return view('supplier.frontend.flashdeal',compact('flashdeal','time'));
        }else{
            return redirect()->route('home');
        }
    }

    public function flashdeal_product_view($id,$code)
    {
        
        $product=Product::where('status',1)->where('id',$id)->first();
        if(empty($product))
        {
            session()->flash('success','Product not found !');
            return redirect()->route('home');
        }
        $seo=Product::where('status',1)->where('id',$id)->select('tag','meta_description')->first();
        $related_product=Product::where('status',1)->where('category_id',$product->category_id)->skip($id)->limit(4)->get();
       
        $sale=Cart::where('user_id', Auth::guard('supplier')->id())
                        ->where('product_id',$id)
                        ->where('purchase_id','1')
                    ->orWhere('ip',request()->ip())
                        ->where('product_id',$id)
                        ->where('purchase_id','1')
                    ->first();
        $time=Flashdeal::where('code',$code)->select('end')->first();
        if(!empty($time))
        {
            $flashdeal=Flashdeal::where('status',1)
                            ->where('start','<=',Carbon::now()->toDateString()) 
                            ->where('end','>=',$time->end)  
                            ->where('product_id',$id)->first();
        }else{
            return redirect()->route('home');
        }
        if($flashdeal==NULL)
        {
            session()->flash('success','Flash deal expired');  
            return redirect()->route('home');
        }else{
            return view('supplier.frontend.flashdeal_product',compact('product','related_product','seo','sale','flashdeal'));
        }
        
    }
    
    public function policy($value)
    {
        $policy=Policy::where('name',$value)->first();
        if($policy==NULL)
        {
            return redirect()->route('home');
        }
        return view('supplier.frontend.policy',compact('policy'));
    }

}
