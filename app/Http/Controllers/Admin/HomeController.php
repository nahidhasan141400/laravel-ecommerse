<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Income; 
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\userlog;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Seosetting;
use App\Models\Supportticket;
use App\Models\Supportticketreply;
use App\Models\Checkout;
use App\Models\Subscribe;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Coupon;
use App\Models\Couponused;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Generalsetting;
use App\Models\Policy;
use App\Models\Link;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Blog;
use App\Models\Inproduct;
use App\Models\Inorder;
use App\Models\Supplierlist; 
use App\Models\Purchaseproduct; 
use App\Models\Category;
use App\Models\Paymentmethodinfo;  
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Mail;
use Validator;
use PDF;

class HomeController extends Controller
{
    public function __construct()
    {
        // return redirect()->route('admin_lock_screen');
        $this->middleware('auth');
    }
    public function admin_dashboard()
    {
       
        $total_sales=Cart::where('purchase_id','1')
                            ->orderBy('id','desc')
                            ->get();
        // $monthly_total_sales=Cart::where('purchase_id','1')
        //                   ->orderBy('id','desc')
        //                   ->limit(30)
        //                   ->get();
        $monthly_total_sales=Cart::where('purchase_id','1')
                             ->whereMonth('updated_at', Carbon::now()->month)
                             ->orderBy('id','desc')
                             ->get();
        $yearly_total_order=Cart::where('purchase_id','1')
                                  ->selectRaw('year(updated_at) year, 
                                  monthname(updated_at) month, 
                                  count(*) as count,product_quentity')
                                  ->groupBy('month')
                                  ->orderBy('month', 'desc')
                                  ->get();
        $count_yearly_total_order=count($yearly_total_order);
        $carts=Cart::where('purchase_id','1')
                  ->groupBy('product_id')
                  ->select('product_quentity','updated_at','product_id')
                  ->selectRaw('count(*) as total,product_id')
                  ->orderBy('id','desc')->limit(30)->get();
        
        $customers=Supplier::all();
        $checkouts=Checkout::select('payment_method')->get();
        $most_reccent_checkouts=Checkout::orderBy('id','desc')->limit(10)->get();
        $product=Product::select('rating')->get();
        return view('admin.dashboard',compact('carts','total_sales','monthly_total_sales','yearly_total_order','count_yearly_total_order','customers','checkouts','most_reccent_checkouts'));
    }
    public function lock_screen()
    {
        $lock_screen=Admin::find(auth()->user()->id);
        $lock_screen->status=2;
        $lock_screen->save();
        return view('admin.lock_screen');
    }

    public function unlock_screen(Request $request)
    {
        $lock_screen=Admin::find(auth()->user()->id);
        if(Hash::check($request->password,$lock_screen->password))
        {
            $lock_screen->status=1;
            $lock_screen->save();
            session()->flash('success','Happy to see you again!');
            return redirect()->route('admin_dashboard');
        }else{
            session()->flash('success','Do not try again!');
            return back();
        }
    }

    public function allstaffs(Request $request)
    {
        $staffs=Admin::orderBy('id','desc')->get();
        return view('admin.allstaffs',compact('staffs'));
    }

    public function allstaffs_active($id)
    {
        if(auth()->user()->role==1)
        {
            $id=request('id');
            $staff = Admin::find($id);
            $staff->status=1; 
            $staff->save();
            session()->flash('success','Staff activated successfully');
            return response()->json(['url'=>route('allstaffs'),'success'=>'ok']);
        }else{
            return back();
        }
    }
    public function allstaffs_deactive($id)
    {
        if(auth()->user()->role==1)
        {
            $id=request('id');
            $staff = Admin::find($id);
            $staff->status=0; 
            $staff->save();
            session()->flash('success','Staff deactivated successfully');
            return response()->json(['url'=>route('allstaffs'),'success'=>'ok']);
        }else{
            return back();
        }
    }
    public function allstaffs_delete($id)
    {
        if(auth()->user()->role==1)
        {
            $id=request('id');
            $staff=Admin::where('id',$id)->delete();
            session()->flash('success','Staff deleted successfully');
            return response()->json(['url'=>route('allstaffs'),'success'=>'ok']);
        }else{
            return back();
        }
    }
    public function allstaffs_edit($id)
    {
        if(auth()->user()->role==1)
        {
            $id=request('id');
            $staff=Admin::find($id);
            $staff->name=request('name');
            $staff->email=request('email');
            // $staff->phone=request('phone');
            $staff->role=request('role');
            if(!empty(request('password')))
            {
                $staff->password=request('password');
            }
            $staff->save();
            session()->flash('success','Staff edited successfully');
            return response()->json(['url'=>route('allstaffs'),'success'=>'ok']);
        }else{
            return back();
        }
    }
    public function conversations_list(Request $request)
    {
        $messages=Conversation::all();
        return view('admin.conversations',compact('messages'));
    }
    public function message($id)
    {
        $id = Crypt::decrypt($id);
        $conversation=Conversation::find($id);
        $reply_messages=Message::where('conversation_id',$id)->orderBy('id','desc')->get();
        $conversation->admin_viewed=1;
        $conversation->save();
        return view('admin.message',compact('conversation','reply_messages'));
    }

    public function message_reply($id)
    {
        $reply= new Message();
        $reply->conversation_id=$id;
        $reply->supplier_id=request('supplier');
        $reply->product_id=request('product');
        $reply->admin=auth()->user()->name;
        $reply->sender=1;
        $reply->receiver=0;
        $reply->reply=request('description');
        session()->flash('success','Message send successfully');
        $reply->save();
        $message=Conversation::find($id);
        if($message->status==1)
        {
            $message->status=0;
            $message->save();
        }
        $message->admin_viewed=1;
        $message->client_viewed=0;
        $message->status=1;
        $message->save();
        return back();
    }
 
    public function customers_list(Request $request)
    {
        $customers=Supplier::all();
        return view('admin.customer',compact('customers'));
    }
    public function customers_delete($id)
    {
        if(auth()->user()->role==1)
        {
            $id=request('id');
            $id = Crypt::decrypt($id);
            $staff=Supplier::where('id',$id)->delete();
            session()->flash('success','Supplier deleted successfully');
            return response()->json(['url'=>route('customers_list'),'success'=>'ok']);
        }else{
            return back();
        }
    }
    public function customer_details_view($id)
    {
        $id=request('id');
        $id = Crypt::decrypt($id);
        $customer=Supplier::find($id);
        return view('admin.customer_details_view',compact('customer'));
    }
    public function be_seller_application($id)
    {
        $id = Crypt::decrypt($id);
        $customer=Supplier::find($id);
        if(request('value')==1)
        {
            $customer->apply=1;
        }else{
            $customer->apply=0;
        }
        $customer->save();
        session()->flash('success','Status updated successfully');
        return response()->json(['url'=>route('customers_list'),'success'=>'ok']);
    }
    public function totalsales(Request $request)
    {
      
        $sales=Checkout::all();
        return view('admin.total_sales',compact('sales'));
    }
    
    public function order_delete($id,Request $request)
    {
        // try {

        // } 
        // catch (\Exception $e) {
          
        //     return redirect()->route('totalsales_history');
        //   }
        try {
            $id=request('id');
            $id = Crypt::decrypt($id);
            $orders=Checkout::find($id);
            $order=Checkout::where('id',$id)->delete();
            $carts=explode(',',$orders->cart_details);
            foreach($carts as $cart)
            {
                $get_cart=Cart::find($cart);
                $get_cart->purchase_id=NULL;
                $product=Product::find($get_cart->product_id);
                $product->current_stock=$product->current_stock+$get_cart->product_quentity;
                $get_cart->save();
                $product->save();
            }
            session()->flash('success','Order deleted successfully');
            return response()->json(['url'=>route('totalsales_history'),'success'=>'ok']);
        } 
        catch (\Exception $e) {
          
            return redirect()->route('totalsales_history');
          }
    }

    public function order_view($id, Request $request)
    {
        
        try {

            $data = Crypt::decrypt($id);
            $order=Checkout::find($data);
            return view('admin.order_view',compact('order'));
          
          } catch (\Exception $e) {
          
            return redirect()->route('totalsales_history');
          }
        
    }
    public function all_order(Request $request)
    {
        $sales=Checkout::all();
        return view('admin.all_order',compact('sales'));
    }
    public function order_details($id, Request $request)
    {
        
        try {

            $data = Crypt::decrypt($id);
            $order=Checkout::where('order_code',$data)->first();
            $orders=Checkout::where('order_code',$data)->get();
            return view('admin.order_details',compact('order','orders'));
          
          } catch (\Exception $e) {
          
            return redirect()->route('all_order');
          }
        
    }
    public function order_payment_status($id, Request $request)
    {
        try {

            $id=request('id');
            $payment=request('pay');
            $data = Crypt::decrypt($id);
            $orders=Checkout::where('order_code',$data)->get();
            foreach($orders as $order)
            {
                $order_u=Checkout::find($order->id);
                $order_u->is_paid=$payment;
                $order_u->save();
            }
            
            session()->flash('success','Payment status updated successfully');
            return response()->json(['url'=>route('all_order'),'success'=>'ok']);
          
          } catch (\Exception $e) {
          
            return redirect()->route('all_order');
          }
    }
    public function order_delivery_status($id, Request $request)
    {
        try {

            $id=request('id');
            $delivery=request('delivery');
            $data = Crypt::decrypt($id);
            $orders=Checkout::where('order_code',$data)->get();
            foreach($orders as $order)
            {
                $order_u=Checkout::find($order->id);
                $order_u->is_completed=$delivery;
                $order_u->save();
            }
            session()->flash('success','Delivery status updated successfully');
            return response()->json(['url'=>route('all_order'),'success'=>'ok']);
          
          } catch (\Exception $e) {
          
            return redirect()->route('all_order');
          }
    }

    public function shipping_cost($id)
    {
        $order=Checkout::find($id);
        if(!empty($order))
        {
            $order->shipping=request('shipping_cost');
            $order->save();
        }
        return back();
    }

    public function allstaffs_role()
    {
        $roles=Role::all();
        return view('admin.roles',compact('roles'));
    }
    public function create_role()
    {
        return view('admin.create_role');
    }
    public function save_role()
    {
        $role=new Role();
        $role->name=request('role_name');
        $data=array();
        $data[0]=request('product');
        $data[1]=request('flashdeal');
        $data[2]=request('order');
        
        $data_name=array();
        $data_name[0]="product";
        $data_name[1]="flashdeal";
        $data_name[2]="order";
        $count=count($data);
        $push="";
        $j=0;
        for($i=0;$i<$count;$i++,$j++)
        {
            if($data[$i]=="on")
            {
                $push= $push.','.($data_name[$j]);
            }
        }
        $role->section=$push;
        $role->save();
        session()->flash('success','Role created successfully');
        return redirect()->route('allstaffs_role');
    }
    public function edit_role($id)
    {
        $role=Role::find($id);
        $sections=explode(",",$role->section);
        return view('admin.edit_role',compact('role','sections'));
    }
    public function edit_role_save($id)
    {
        $role=Role::find($id);
        $role->name=request('role_name');
        $data=array();
        $data[0]=request('product');
        $data[1]=request('flashdeal');
        $data[2]=request('order');
        
        $data_name=array();
        $data_name[0]="product";
        $data_name[1]="flashdeal";
        $data_name[2]="order";
        $count=count($data);
        $push="";
        $j=0;
        for($i=0;$i<$count;$i++,$j++)
        {
            if($data[$i]=="on")
            {
                $push= $push.','.($data_name[$j]);
            }
        }
        $role->section=$push;
        $role->save();
        session()->flash('success','Role edited successfully');
        return redirect()->route('allstaffs_role');
    }

    public function delete_role($id)
    {
        if(auth()->user()->role==1)
        {
            $id=request('id');
            $staff=Role::where('id',$id)->delete();
            session()->flash('success','Role deleted successfully');
            return response()->json(['url'=>route('allstaffs_role'),'success'=>'ok']);
        }else{
            return back();
        }
    }
    public function home_seo()
    {
        $seosetting=Seosetting::first();
        if($seosetting==NULL)
        {
            $seosetting=new Seosetting();
            $seosetting->keyword='Keyword';
            $seosetting->author='Author';
            $seosetting->sitemap='Sitemap';
            $seosetting->description='Description';
            $seosetting->save();
        }
        $keywords=explode(",",$seosetting->keyword);
        return view('admin.seo',compact('seosetting','keywords'));
    }
    public function home_seo_submit()
    {
        $seosetting=Seosetting::first();
        if(!empty($seosetting))
        {
            $seosetting=Seosetting::find($seosetting->id);
            $keyword=request("keyword");
            $count=count($keyword);
            $push="";
            for($i=0;$i<$count;$i++)
            {
                $push= $push.','.($keyword[$i]);
            }
            $seosetting->keyword=$push;
            $seosetting->author=request("author");
            $seosetting->sitemap=request("sitemap");
            $seosetting->description=request("description");
            $seosetting->save();
            session()->flash('success','Seo details added successfully');
            return redirect()->route('home_seo');
        }else{
            $seosetting=new Seosetting();
            $keyword=request("keyword");
            $count=count($keyword);
            $push="";
            for($i=0;$i<$count;$i++)
            {
                $push= $push.','.($keyword[$i]);
            }
            $seosetting->keyword=$push;
            $seosetting->author=request("author");
            $seosetting->sitemap=request("sitemap");
            $seosetting->description=request("description");
            $seosetting->save();
            session()->flash('success','Seo details added successfully');
            return redirect()->route('home_seo');
        }

    }

    public function support_tickets()
    {
        $tickets=Supportticket::all();
        return view('admin.ticket',compact('tickets'));
    }
    public function support_tickets_reply($id)
    {
        $tickets=Supportticket::find($id);
        $reply_messages=Supportticketreply::where('supportticket_id',$id)->orderBy('id','desc')->get();
        $tickets->viewed=1;
        $tickets->save();
        return view('admin.ticket_reply',compact('tickets','reply_messages'));
    }
    public function support_tickets_reply_submit($id)
    {
        $reply= new Supportticketreply();
        $reply->supportticket_id=$id;
        $reply->supplier_id=request('supplier');
        $reply->admin=auth()->user()->name;
        $reply->sender=1;
        $reply->reply=request('description');
        session()->flash('success','Message send successfully');
        $reply->save();
        $tickets=Supportticket::find($id);
        if($tickets->status==1)
        {
            $tickets->status=0;
            $tickets->save();
        }
        $tickets->viewed=1;
        $tickets->client_viewed=0;
        $tickets->status=1;
        $tickets->save();
        return back();

    }
    public function newslater()
    {
        $subscribers=Subscribe::select('email')->get();
        $suppliers=Supplier::select('email')->get();
        return view('admin.newslatter',compact('subscribers','suppliers'));
    }
    public function newslater_submit(Request $request)
    {
        $data = [
            'description'=>request("description")
        ];
        $user=request("user");
        $subscriber=request("subscriber");
        if(!empty($user) && !empty($subscriber))
        {
            $email = array_merge($subscriber,$user);
        }elseif(!empty($user) && empty($subscriber))
        {
            $email=$user;
        }elseif(empty($user) && !empty($subscriber))
        {
            $email=$subscriber;
        }else{
            return back();
        }
       
        $subject=request("subject");
        Mail::send('admin.email',$data, function($message) use ($email,$subject)
        {
            $message->from('goads444@gmail.com','Luxury hut')
                    ->to($email)
                    ->subject($subject);
        });
        session()->flash('success','Message send successfully');
        return back();
    }
    public function header_setting()
    {
        return view('admin.header_setting');
    }
    public function sidebar_setting()
    {
        return view('admin.sidebar_setting');
    }
    public function body_setting()
    {
        return view('admin.body_setting');
    }
    public function footer_setting()
    {
        return view('admin.footer_setting');
    }

    public function blog()
    {
        $blogs=Blog::orderBy('id','desc')->get();
        return view('admin.blog',compact('blogs'));
    }
    public function blog_save(Request $request)
    {
        $blog=new Blog();
        $logo = $request->file('logo');
        $fileName =time().'.'.$logo->getClientOriginalExtension();
        $path=$request->file('logo')->move(public_path('assets/frontend/image/blog'), $fileName);
        
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->added_by= auth()->user()->name;
        $blog->image= $fileName;
        $blog->save();
        session()->flash('success','Blog added successfully');
        return response()->json(['url'=>route('admin_blog'),'success'=>'ok']);
    }
    public function blogedit($id,Request $request)
    {
        $blog=Blog::find($request->id);
        if(!empty($blog))
        {
            if($request->hasFile('logo'))
            {
                $logo = $request->file('logo');
                $fileName =time().'.'.$logo->getClientOriginalExtension();
                $path=$request->file('logo')->move(public_path('assets/frontend/image/blog'), $fileName);
                $blog->image= $fileName;
            }
            $blog->title=$request->title;
            $blog->description=$request->description;
            $blog->added_by= auth()->user()->name;
            $blog->save();
            session()->flash('success','Blog updated successfully');
        }
        return response()->json(['url'=>route('admin_blog'),'success'=>'ok']);
    }
    public function blogdelete($id)
    {
        $id = Crypt::decrypt($id);
        $blog=Blog::where('id',$id)->delete();
        session()->flash('success','Blog deleted successfully');
        return response()->json(['url'=>route('admin_blog'),'success'=>'ok']);
    }
   
   
    public function who(Request $request)
    {
        $date=Carbon::now()->format('Y-m-d');

        $who = userlog::groupBy('ip')
                    ->where('created_at','like',"%$date%")
                    ->select('email','user_agent','role')
                    ->selectRaw('count(*) as total, ip')
                    ->get();
        return view('admin.who',compact('who'));
    }

    public function coupon_list()
    {
        $coupons=Coupon::orderBy('id','desc')->get();
        return view('admin.coupon',compact('coupons'));
    }
    public function coupon_delete($id)
    {
        $coupons=Coupon::where('id',$id)->delete();
        return back();
    }
    public function coupon_create()
    {
        return view('admin.create_coupon');
    }
    public function coupon_create_submit(Request $request)
    {
       $coupon=new Coupon();
       $couponused=new Couponused();
        if($request->type==1)
       {
            $coupon->type=$request->type;
            $coupon->code=$request->code;
            $category=$request->category;
            $count_category=count($category);
            $push_category="";
            for($i=0;$i<$count_category;$i++)
            {
                $push_category= $push_category.','.($category[$i]);
            }
            $subcategory=$request->subcategory;
            $count_subcategory=count($subcategory);
            $push_subcategory="";
            for($i=0;$i<$count_subcategory;$i++)
            {
                $push_subcategory= $push_subcategory.','.($subcategory[$i]);
            }
            $product=$request->product;
            $count_product=count($product);
            $push_product="";
            for($i=0;$i<$count_subcategory;$i++)
            {
                $push_product= $push_product.','.($product[$i]);
            }
            $coupon->category_id=trim($push_category,',');
            $coupon->subcategory_id=trim($push_subcategory,',');
            $coupon->product_id=trim($push_product,',');
            $coupon->start_date=$request->s_date;
            $coupon->end_date=$request->e_date;
            $coupon->discount=$request->product_discount;
            $coupon->save();
            session()->flash('success','Coupon created successfully');
            return back();
       }elseif($request->type==2){
            $coupon->type=$request->type;
            $coupon->code=$request->codes;
            $coupon->discount=$request->product_discounts;
            $coupon->minimum_shopping_amount=$request->minimum_shopping;
            $coupon->maximum_discount_amount=$request->maximum_product_discount;
            $coupon->start_date=$request->st_date;
            $coupon->end_date=$request->et_date;
            $coupon->save();
            session()->flash('success','Coupon created successfully');
            return back();
       }else{
            session()->flash('success','Coupon not created');
            return back();
       }
    }

    public function frontend_home()
    {
        $sliders=Slider::all();
        $banners1=Banner::where('position',1)->get();
        $banners2=Banner::where('position',2)->get();
        return view('admin.home',compact('sliders','banners1','banners2'));
    }
    public function add_slider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
          ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first(),'val_error'=>"ok"]);
        }elseif($request->hasFile('image')){
            $image = $request->file('image');
            $fileName =time().'.'.$image->getClientOriginalExtension();
            $path=$request->file('image')->move(public_path('assets/frontend/image/banners/'), $fileName);
            $slider= new Slider();
            $slider->photo= $fileName;
            $slider->save();
            session()->flash('success','Slider added successfully');
            return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }
    }

    public function slider_delete($id)
    {
        $id = Crypt::decrypt($id);
        if(auth()->user()->role==1){
        $slider=Slider::where('id',$id)->delete();
        session()->flash('success','Slider deleted successfully');
            return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }else{
            return back();
        }

    }

    public function slider_active($id)
    {
        $id = Crypt::decrypt($id);
        if(auth()->user()->role==1){
        $slider=Slider::find($id);
        $slider->status=1;
        $slider->save();
        session()->flash('success','Slider activeted successfully');
            return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }else{
            return back();
        }

    }

    public function slider_deactive($id)
    {
        $id = Crypt::decrypt($id);
        if(auth()->user()->role==1){
        $slider=Slider::find($id);
        $slider->status=0;
        $slider->save();
        session()->flash('success','Slider deactiveted successfully');
            return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }else{
            return back();
        }

    }


    public function add_banner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
          ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first(),'val_error'=>"ok"]);
        }elseif($request->hasFile('image')){
            $image = $request->file('image');
            $fileName =time().'.'.$image->getClientOriginalExtension();
            $path=$request->file('image')->move(public_path('assets/frontend/image/banners/'), $fileName);
            $slider= new Banner();
            $slider->photo= $fileName;
            $slider->position=$request->position;
            $slider->description=$request->description;
            $slider->url=$request->url;
            $slider->save();
            session()->flash('success','Banner added successfully');
            return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }
    }

    public function banner_delete($id)
    {
        $id = Crypt::decrypt($id);
        if(auth()->user()->role==1){
        $slider=Banner::where('id',$id)->delete();
        session()->flash('success','Banner deleted successfully');
        return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }else{
            return back();
        }

    }

    public function banner_active($id)
    {
        $id = Crypt::decrypt($id);
        if(auth()->user()->role==1){
        $slider=Banner::find($id);
        $slider->status=1;
        $slider->save();
        session()->flash('success','Banner activeted successfully');
            return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }else{
            return back();
        }

    }

    public function banner_deactive($id)
    {
        $id = Crypt::decrypt($id);
        if(auth()->user()->role==1){
        $slider=Banner::find($id);
        $slider->status=0;
        $slider->save();
        session()->flash('success','Banner deactiveted successfully');
        return response()->json(['url'=>route('frontend_home'),'success'=>'ok']);
        }else{
            return back();
        }

    }
    

    public function general_setting()
    {
        $setting=Generalsetting::first();
        return view('admin.setting',compact('setting'));
    }
    public function general_setting_submit(Request $request)
    {
        $setting=Generalsetting::first();
        if(!empty($setting))
        {
          
            $setting=Generalsetting::find($setting->id);
            if($request->hasFile('frontendlogo'))
            {
                $image = $request->file('frontendlogo');
                $fileName =time().'.'.$image->getClientOriginalExtension();
                $path=$request->file('frontendlogo')->move(public_path('assets/images/setting'), $fileName);
                $setting->logo=$fileName;
            }
            if($request->hasFile('backendlogo'))
            {
                $image = $request->file('backendlogo');
                $fileName =time().'.'.$image->getClientOriginalExtension();
                $path=$request->file('backendlogo')->move(public_path('assets/images/setting'), $fileName);
                $setting->admin_logo=$fileName;
            }
            if($request->hasFile('favicon'))
            {
                $image = $request->file('favicon');
                $fileName =time().'.'.$image->getClientOriginalExtension();
                $path=$request->file('favicon')->move(public_path('assets/images/setting'), $fileName);
                $setting->favicon=$fileName;
            }
            $setting->color=request("color");
            $setting->address=request("address");
            $setting->description=request("description");
            $setting->phone=request("phone");
            $setting->email=request("email");
            $setting->facebook=request("facebook");
            $setting->instagram=request("instagram");
            $setting->twitter=request("twitter");
            $setting->youtube=request("youtube");
            $setting->linkedin=request("linkedin");
            $setting->save();
           
            session()->flash('success','General setting updated successfully');
            return redirect()->route('general_setting');
        }else{
            $validator = Validator::make($request->all(), [
                'frontendlogo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'backendlogo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'favicon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
              ]);
            if ($validator->fails()) {
                return back();
            }
            $setting=new Generalsetting();
            $setting->color=request("color");
            $setting->address=request("address");
            $setting->description=request("description");
            $setting->phone=request("phone");
            $setting->email=request("email");
            $setting->facebook=request("facebook");
            $setting->instagram=request("instagram");
            $setting->twitter=request("twitter");
            $setting->youtube=request("youtube");
            $setting->linkedin=request("linkedin");
            $setting->save();
            session()->flash('success','General setting added successfully');
            return redirect()->route('general_setting');
        }
    }

    public function about_us()
    {
        $policy=Policy::where('name','about_us')->first();
        return view('admin.sellerpolicy',compact('policy'));
    }
    public function size_guide()
    {
        $policy=Policy::where('name','size_guide')->first();
        return view('admin.supportpolicy',compact('policy'));
    }
    public function return_policy()
    {
        $policy=Policy::where('name','return_policy')->first();
        return view('admin.returnpolicy',compact('policy'));
    }
    public function terms_condition()
    {
        $policy=Policy::where('name','terms_condition')->first();
        return view('admin.termscondition',compact('policy'));
    }
    public function faq()
    {
        $policy=Policy::where('name','faq')->first();
        return view('admin.faq',compact('policy'));
    }
    public function contact()
    {
        $policy=Policy::where('name','contact')->first();
        return view('admin.contact',compact('policy'));
    }
    public function allpolicy(Request $request)
    {
        if($request->name=="about_us")
        {
            $policy=Policy::where('name','about_us')->first();
            if(!empty($policy))
            {
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }else{
                $policy= new Policy();
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }
            session()->flash('success','About us added successfully');
            return redirect()->route('about_us');
        }elseif($request->name=="return_policy")
        {
            $policy=Policy::where('name','return_policy')->first();
            if(!empty($policy))
            {
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }else{
                $policy= new Policy();
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }
            session()->flash('success','Policy added successfully');
            return redirect()->route('return_policy');
        }elseif($request->name=="size_guide")
        {
            $policy=Policy::where('name','size_guide')->first();
            if(!empty($policy))
            {
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }else{
                $policy= new Policy();
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }
            session()->flash('success','Size guide added successfully');
            return redirect()->route('size_guide');
        }elseif($request->name=="terms_condition")
        {
            $policy=Policy::where('name','terms_condition')->first();
            if(!empty($policy))
            {
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }else{
                $policy= new Policy();
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }
            session()->flash('success','Terms and condition added successfully');
            return redirect()->route('terms_condition');
        }elseif($request->name=="faq")
        {
            $policy=Policy::where('name','faq')->first();
            if(!empty($policy))
            {
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }else{
                $policy= new Policy();
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }
            session()->flash('success','Terms and condition added successfully');
            return redirect()->route('faq');
        }
        elseif($request->name=="contact")
        {
            $policy=Policy::where('name','contact')->first();
            if(!empty($policy))
            {
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }else{
                $policy= new Policy();
                $policy->name=$request->name;
                $policy->content=$request->description;
                $policy->save();
            }
            session()->flash('success','Terms and condition added successfully');
            return redirect()->route('contact');
        }
        else{
            session()->flash('success','Please try again successfully');
            return redirect()->route('about_us');
        }
        
    }
    public function usefullinks()
    {
        $links=Link::all();
        return view('admin.usefulllinks',compact('links'));
    }
    public function usefullink_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'required',
          ]);
        if ($validator->fails()) {
            session()->flash('success','Please try again');
            return response()->json(['url'=>route('usefullinks'),'success'=>'ok']);
        }else{
            $link= new Link();
            $link->name=$request->name;
            $link->link=$request->url;
            $link->save();
            session()->flash('success','Link created successfully');
            return response()->json(['url'=>route('usefullinks'),'success'=>'ok']);
        }
    }

    public function usefullink_edit($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'required',
          ]);
        if ($validator->fails()) {
            session()->flash('success','Please try again');
            return response()->json(['url'=>route('usefullinks'),'success'=>'ok']);
        }else{
            $link=Link::find($request->id);
            $link->name=$request->name;
            $link->link=$request->url;
            $link->save();
            session()->flash('success','Link updated successfully');
            return response()->json(['url'=>route('usefullinks'),'success'=>'ok']);
        }
    }

    public function usefullink_delete($id,Request $request)
    {
            $id=$request->id;
            $id = Crypt::decrypt($id);
            $link=Link::find($id);
            if(!empty($link))
            {
                $link=Link::where('id',$id)->delete();
                session()->flash('success','Link deleted successfully');
                return response()->json(['url'=>route('usefullinks'),'success'=>'ok']);
            }else{
                session()->flash('success','Please try again');
                return response()->json(['url'=>route('usefullinks'),'success'=>'ok']);
            }
           
        
    }

    public function stock_report()
    {
        $products=Product::select('name','current_stock','current_location','finish_alert')->get();
        return view('admin.stockreport',compact('products'));
    }
    public function sale_report()
    {
        $products=Product::select('name','num_of_sale')->get();
        return view('admin.salereport',compact('products'));
    }
    public function wish_report()
    {
        $wishlists=Wishlist::select('product_id','product_quentity')->get();
        return view('admin.wishreport',compact('wishlists'));
    }

    public function pdf_download($id,$order_code,Request $request)
    {
        $id=$request->id;
        $id = Crypt::decrypt($id);
        $order_code = Crypt::decrypt($order_code);
        $order_code=$order_code.'.pdf';

        $order=Checkout::find($id);
        $invoice=Invoice::where('order_code',$order->order_code)->first();
        if(!empty($invoice))
        {
            $invoice->invoice_code=rand(100000,999999);
            $invoice->save();
        }else{
            $invoice= new Invoice();
            $invoice->invoice_code=rand(100000,999999);
            $invoice->order_code=$order->order_code;
            $invoice->save();
        }
        $invoice=Invoice::where('order_code',$order->order_code)->first();
        $general_setting=Generalsetting::orderBy('id','desc')->first();
        $pdf = PDF::loadView('admin.invoice',compact('order','general_setting','invoice'));
        // $pdf=$pdf->download($order_code);
        // return $pdf;
        return $pdf->stream('invoice.pdf');
    }

    public function cycle_counting()
    {
        $products=Cart::where('purchase_id',1)->select('product_id','product_quentity','updated_at')->get();
        return view('admin.cycle_counting',compact('products'));
    }

    public function in_house_products()
    {
        $products=Inproduct::all();
        return view('admin.house_product',compact('products'));
    }

    public function in_house_products_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
    
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first(),'val_error'=>"ok"]);
        }else if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName =time().'.'.$image->getClientOriginalExtension();
            $path=$request->file('image')->move(public_path('assets/images/inproduct'), $fileName);
            $inproduct=new Inproduct();
            $inproduct->name=request('name');
            $inproduct->image=$fileName;
            $inproduct->current_location=request('current_location');
            $inproduct->quentity=request('quentity');
            $inproduct->current_quentity=request('quentity');
            $inproduct->added_by=auth()->user()->name;   
            $inproduct->save();
            session()->flash('success','Product added successfully');
            return response()->json(['url'=>route('in_house_products'),'success'=>'ok']);
        }
    }

    public function in_house_products_update__submit(Request $request,$id)
    {
        $inproduct=Inproduct::find($id);
        if(!empty($inproduct))
        {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName =time().'.'.$image->getClientOriginalExtension();
                $path=$request->file('image')->move(public_path('assets/images/inproduct'), $fileName);
                $inproduct->name=request('name');
                $inproduct->image=$fileName;
                if(!empty(request('quentity')))
                {
                    
                    $inproduct->quentity=$inproduct->quentity+request('quentity');
                    $inproduct->current_quentity=$inproduct->current_quentity+request('quentity');
                }
                $inproduct->current_location=request('current_location');
                $inproduct->added_by=auth()->user()->name;   
                if(!empty(request('order_quentity')) && !empty(request('order_by')))
                {
                    $inorder=new Inorder();
                    $inorder->product_id=$inproduct->id;
                    $inorder->orderBy=$request->order_by;
                    $inorder->quantity=$request->order_quentity;
                    $inorder->id_no=$request->id_no;
                    $inorder->comment=$request->comment;
                    $inproduct->current_quentity= $inproduct->quentity-$inorder->quantity;
                    $inorder->save();
                }
                $inproduct->save();
            }else if(!$request->hasFile('image')){
                $inproduct->name=request('name');
                $inproduct->current_location=request('current_location');
                if(!empty(request('quentity')))
                {
                    
                    $inproduct->quentity=$inproduct->quentity+request('quentity');
                    $inproduct->current_quentity=$inproduct->current_quentity+request('quentity');
                }
                $inproduct->added_by=auth()->user()->name;
                if(!empty(request('order_quentity')) && !empty(request('order_by')))
                {
                    $inorder=new Inorder();
                    $inorder->product_id=$inproduct->id;
                    $inorder->orderBy=$request->order_by;
                    $inorder->quantity=$request->order_quentity;
                    $inorder->id_no=$request->id_no;
                    $inorder->comment=$request->comment;
                    $inproduct->current_quentity= $inproduct->quentity-$inorder->quantity;
                    $inorder->save();

                }   
                $inproduct->save();
            }
        }
        session()->flash('success','Action successfully');
        return response()->json(['url'=>route('in_house_products'),'success'=>'ok']);
    }

    public function in_house_products_delete($id)
    {
        $id = Crypt::decrypt($id);
        $inproduct=Inproduct::find($id);
        if(!empty($inproduct))
        {
            Inproduct::where('id',$id)->delete();
            session()->flash('success','Product deleted successfully');
            return response()->json(['url'=>route('in_house_products'),'success'=>'ok']);
        }
    }

    public function inorder_view()
    {
        $inorders=Inorder::all();
        return view('admin.inorder_view',compact('inorders'));
    }

    public function supplier_list()
    {
        $supplierlists=Supplierlist::orderBy('id','desc')->get();
        return view('admin.supplier_list',compact('supplierlists'));
    }

    public function supplier_list_submit(Request $request)
    {
        $supplierlist=new Supplierlist();
        $supplierlist->code=$request->code;
        $supplierlist->name=$request->name;
        $supplierlist->email=$request->email;
        $supplierlist->address=$request->address;
        $supplierlist->phone=$request->phone;
        $supplierlist->group=$request->group;
        $supplierlist->save();
        session()->flash('success','Supplier added successfully');
        return response()->json(['url'=>route('supplier_list'),'success'=>'ok']);
    }

    public function supplier_active($id)
    {
        $id = Crypt::decrypt($id);
        $supplierlists=Supplierlist::find($id);
        if(!empty($supplierlists))
        {
            $supplierlists->status=1;
            $supplierlists->save();
        }
        session()->flash('success','Supplier activated successfully');
        return response()->json(['url'=>route('supplier_list'),'success'=>'ok']);
    }
    public function supplier_deactive($id)
    {
        $id = Crypt::decrypt($id);
        $supplierlists=Supplierlist::find($id);
        if(!empty($supplierlists))
        {
            $supplierlists->status=0;
            $supplierlists->save();
        }
        session()->flash('success','Supplier deactivated successfully');
        return response()->json(['url'=>route('supplier_list'),'success'=>'ok']);
    }
    public function supplier_list_delete($id)
    {
        $id = Crypt::decrypt($id);
        $supplierlists=Supplierlist::where('id',$id)->delete();
        session()->flash('success','Supplier deleted successfully');
        return response()->json(['url'=>route('supplier_list'),'success'=>'ok']);
    }

    public function purchase_product()
    {
        $supplierlists=Supplierlist::where('status',1)->get();
        $category=Category::where('parent_id',NULL)->get();
        $purchaseproducts=Purchaseproduct::orderBy('id','desc')->get();
        return view('admin.purchase_product',compact('purchaseproducts','supplierlists','category'));
    }

    public function purchase_product_save(Request $request)
    {
        if($request->name=="0")
        {
            return;
        }
        if($request->amount_pay=="0")
        {
            return;
        }
        $name = Crypt::decrypt($request->name);
        $purchaseproduct=new Purchaseproduct();
        $purchaseproduct->supplierlist_id=$name;
        $purchaseproduct->category=$request->category;
        $purchaseproduct->chalan_no=$request->chalan;
        $purchaseproduct->order_id=$request->order_id;
        $purchaseproduct->amount=serialize($request->amount);
        $purchaseproduct->name=serialize($request->item_code);
        $purchaseproduct->quantity=serialize($request->quantity);
        $purchaseproduct->save();
        $invoice=new Invoice();
        $invoice->invoice_code=rand(100000,999999);
        $invoice->order_code=$purchaseproduct->order_id;
        $invoice->save();
        session()->flash('success','Product added successfully');
        return response()->json(['url'=>route('purchase_product'),'success'=>'ok']);
    }

    public function purchase_product_active($id)
    {
        $id = Crypt::decrypt($id);
        $purchaseproduct=Purchaseproduct::find($id);
        if(!empty($purchaseproduct))
        {
            $purchaseproduct->status=1;
            $purchaseproduct->save();
        }
        session()->flash('success','Product Activated successfully');
        return response()->json(['url'=>route('purchase_product'),'success'=>'ok']);
    }

    public function purchase_product_deactive($id)
    {
        $id = Crypt::decrypt($id);
        $purchaseproduct=Purchaseproduct::find($id);
        if(!empty($purchaseproduct))
        {
            $purchaseproduct->status=0;
            $purchaseproduct->save();
        }
        session()->flash('success','Product Activated successfully');
        return response()->json(['url'=>route('purchase_product'),'success'=>'ok']);
    }

    public function purchase_product_delete($id)
    {
        $id = Crypt::decrypt($id);
        $purchaseproduct=Purchaseproduct::find($id);
        if(!empty($purchaseproduct))
        {
            Purchaseproduct::where('id',$id)->delete();
        }
        session()->flash('success','Product deleted successfully');
        return response()->json(['url'=>route('purchase_product'),'success'=>'ok']);
    }

    public function purchase_product_edit($id)
    {
        $id = Crypt::decrypt($id);
        $supplierlists=Supplierlist::where('status',1)->get();
        $purchaseproduct=Purchaseproduct::find($id);
        $category=Category::where('parent_id',NULL)->get();
        $purchase_category_product=Purchaseproduct::where('category',$purchaseproduct->category)->get();
        return view('admin.purchase_product_edit',compact('purchaseproduct','supplierlists','category','purchase_category_product'));
    }

    public function purchase_product_edit_submit(Request $request,$id)
    {

        // dd($request->all());
        $id = Crypt::decrypt($id);
        $purchaseproduct=Purchaseproduct::find($id);
        if(empty($purchaseproduct))
        {
            return;
        }
        if($request->name=="0")
        {
            return;
        }
        $name = Crypt::decrypt($request->pname);

        $purchaseproduct->supplierlist_id=$name;
        $purchaseproduct->order_id=$request->order_id;
        $purchaseproduct->chalan_no=$request->chalan;
        $purchaseproduct->category=$request->product_category;
        $push="";
        foreach($request->price as $price)
        {
            $push=$push.','.$price;
        }
        $all_price=trim($push,',');
        $purchaseproduct->amount=serialize($all_price);

        $push="";
        foreach($request->product_name as $item_code)
        {
            $push=$push.','.$item_code;
        }
        $all_code=trim($push,',');
        $purchaseproduct->name=serialize($all_code);

        $push="";
        foreach($request->quantity as $quantity)
        {
            $push=$push.','.$quantity;
        }
        $all_quantity=trim($push,',');
        $purchaseproduct->quantity=serialize($all_quantity);
        
        $purchaseproduct->save();
        session()->flash('success','Product updated successfully');
        return redirect()->route('purchase_product');
    }

    public function pdf_purchaseproduct($id,$order_id)
    {
        $id = Crypt::decrypt($id);
        $order_id = Crypt::decrypt($order_id);

        $order_code=$order_id.'.pdf';

        $order=Purchaseproduct::where('id',$id)->where('order_id',$order_id)->first();
        $invoice=Invoice::where('order_code',$order->order_id)->first();
        if(!empty($invoice))
        {
            $invoice->invoice_code=rand(100000,999999);
            $invoice->save();
        }else{
            $invoice= new Invoice();
            $invoice->invoice_code=rand(100000,999999);
            $invoice->order_code=$order->order_id;
            $invoice->save();
        }
        $invoice=Invoice::where('order_code',$order->order_id)->first();
        $general_setting=Generalsetting::orderBy('id','desc')->first();
        $pdf = PDF::loadView('admin.purchase_invoice',compact('order','general_setting','invoice'));
        // $pdf=$pdf->download($order_code);
        // return $pdf;
        return $pdf->stream('invoice.pdf');
    }

    public function purchase_product_category($id)
    {
       $categorys=Purchaseproduct::where('category',$id)->get();
       $allnames="";
       foreach($categorys as $category)
       {
        $names=explode(',',unserialize($category->name));
        foreach($names as $name)
        {
            $allnames=$allnames.','.$name;
        }
       }
       $allnames_final=trim($allnames,',');
       return response()->json(['success'=>'ok','name'=>$allnames_final]);
    }



    public function payment_i()
    {
        $paymentmethodinfo=Paymentmethodinfo::first();
        if($paymentmethodinfo==NULL)
        {
            $paymentmethodinfo=new Paymentmethodinfo();
            $paymentmethodinfo->store_id='11111';
            $paymentmethodinfo->store_password='22222';
            $paymentmethodinfo->save();
        }
        return view('admin.payment_method_info',compact('paymentmethodinfo'));
    }

    public function payment_method_submit(Request $request)
    {
        $paymentmethodinfo=Paymentmethodinfo::first();
        if(!empty($paymentmethodinfo))
        {
            $paymentmethodinfo->store_id=$request->author;
            $paymentmethodinfo->store_password=$request->sitemap;
            $paymentmethodinfo->save();
 
            session()->flash('success','Details added successfully');
            return redirect()->route('payment_i');
        }else{
            $paymentmethodinfo=new Paymentmethodinfo();
            $paymentmethodinfo->store_id=$request->author;
            $paymentmethodinfo->store_password=$request->sitemap;
            $paymentmethodinfo->save();
            session()->flash('success','Details added successfully');
            return redirect()->route('payment_i');
        }

    }


   

}
