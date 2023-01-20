<?php

namespace App\Http\Controllers\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Income; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Supplier;
use App\Models\Message;
use App\Models\Checkout;
use App\Models\Wishlist;
use App\Models\Conversation;
use App\Models\Supportticket;
use App\Models\Supportticketreply;

use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product; 
use App\Models\Productimage;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }
    public function supplier_dashboard()
    {
        $orders=Checkout::where('customer_id',Auth::guard('supplier')->id())->get();
        return view('supplier.dashboard',compact('orders'));
    }
    public function wishlist()
    {
        return view('supplier.wishlist');
    }
    public function delete_wishlist($id)
    {
        $id = Crypt::decrypt($id);
        $wishlist=Wishlist::where('id',$id)->delete();
        session()->flash('success','Wishlist deleted successfully');
        return back();
    }
    public function manage_profile()
    {
        $manage_profile=Supplier::find(Auth::guard('supplier')->id());
        return view('supplier.manage_profile',compact('manage_profile'));
    }
    public function manage_profile_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
        $manage_profile=Supplier::find(Auth::guard('supplier')->id());
        $manage_profile->name=request('name');
        if ($request->hasFile('image')) {
            $logo = $request->file('image');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('image')->move(public_path('assets/images/profile'), $fileName);
            $manage_profile->image= $fileName;
        }
        $manage_profile->phone=request('phone');
        $manage_profile->address=request('address');
        $manage_profile->country=request('val-skill');
        $manage_profile->city=request('city');
        $manage_profile->postal_code=request('postal_code');
        if($request->oldpassword!=NULL && $request->newpassword!=NULL)
        {
            if(Hash::check($request->oldpassword, $manage_profile->password))
            {
                $manage_profile->password=Hash::make($request->newpassword);
            }else{
                session()->flash('success','Incorrect password');
                return back();
            }
        }
        $manage_profile->save();
        session()->flash('success','Profile updated successfully!');
        return back();
    }
    public function short_message()
    {
        $product_id=request('product_id');
        $product_name=request('product_name');
        $supplier_id=request('supplier_id');
        $short_message=request('message');
        $message= new Message();
        $conversations= Conversation::where('product_id',$product_id)->first();
        if(!empty($conversations))
        {
            $message->conversation_id=$conversations->id;
            $message->supplier_id=$supplier_id;
            $message->product_id=$product_id;
            $message->reply=$short_message;
            $message->sender=0;
            $message->receiver=1;
            $message->save();
        }else{
            $conversations=new Conversation();
            $conversations->product_id=$product_id;
            $conversations->supplier_id=$supplier_id;
            $conversations->admin_id=2;
            $conversations->subject=$product_name;
            $conversations->status=0;
            $conversations->admin_viewed=0;
            $conversations->client_viewed=1;
            $conversations->save();

            $message->conversation_id=$conversations->id;
            $message->supplier_id=$supplier_id;
            $message->product_id=$product_id;
            $message->reply=$short_message;
            $message->sender=0;
            $message->receiver=1;
            $message->save();


        }
        return response()->json(['message'=>'Message send successfully','success'=>'ok']);
    }
    public function support_ticket()
    {
        $tickets=Supportticket::where('supplier_id',auth()->user()->id)->get();
        return view('supplier.support_ticket',compact('tickets'));
    }
    public function support_tickets_reply($id)
    {
        $id = Crypt::decrypt($id);
        $tickets=Supportticket::find($id);
        $reply_messages=Supportticketreply::where('supportticket_id',$id)->orderBy('id','desc')->get();
        $tickets->client_viewed=1;
        $tickets->save();
        return view('supplier.ticket_reply',compact('tickets','reply_messages'));
    }

    public function support_ticket_reply_submit($id)
    {
        $id = Crypt::decrypt($id);
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
        $tickets->viewed=0;
        $tickets->client_viewed=1;
        $tickets->status=1;
        $tickets->save();
        return back();
    }

    public function create_support_ticket()
    {
        return view('supplier.create_support_ticket');
    }
    public function create_support_ticket_submit(Request $request)
    {
        $ticket=new Supportticket();
        $ticket->code=rand(100000,999999);
        $ticket->supplier_id=auth()->user()->id;
        $ticket->subject=$request->subject;
        $ticket->details=$request->description;
        $ticket->status=0;
        $ticket->viewed=0;
        $ticket->client_viewed=1;
        $ticket->save();
        return redirect()->route('support_ticket');
    }

    public function conversations_list()
    {
        $messages=Conversation::where('supplier_id',auth()->user()->id)->get();
        return view('supplier.conversation',compact('messages'));
    }
    public function conversations_message($id)
    {
        $id = Crypt::decrypt($id);
        $conversation=Conversation::find($id);
        $reply_messages=Message::where('conversation_id',$id)->orderBy('id','desc')->get();
        $conversation->client_viewed=1;
        $conversation->save();
        return view('supplier.message',compact('conversation','reply_messages'));
    }
    public function conversations_message_reply($id)
    {
        $id = Crypt::decrypt($id);
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
        $message->admin_viewed=0;
        $message->client_viewed=1;
        $message->status=1;
        $message->save();
        return back();
    }
    public function be_seller()
    {
        $manage_profile=Supplier::find(Auth::guard('supplier')->id());
        return view('supplier.be_a_seller',compact('manage_profile')) ;
    }

    public function be_seller_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_first' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_second' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'trade' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
        $manage_profile=Supplier::find(Auth::guard('supplier')->id());
        $manage_profile->name=request('name');
        if ($request->hasFile('image')) {
            $logo = $request->file('image');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('image')->move(public_path('assets/images/profile'), $fileName);
            $manage_profile->image= $fileName;
        }
        if ($request->hasFile('nid_first')) {
            $logo = $request->file('nid_first');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('nid_first')->move(public_path('assets/images/profile'), $fileName);
            $manage_profile->id_image_1= $fileName;
        }
        if ($request->hasFile('nid_second')) {
            $logo = $request->file('nid_second');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('nid_second')->move(public_path('assets/images/profile'), $fileName);
            $manage_profile->id_image_2= $fileName;
        }
        if ($request->hasFile('trade')) {
            $logo = $request->file('trade');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('trade')->move(public_path('assets/images/profile'), $fileName);
            $manage_profile->trade_image_1= $fileName;
        }
        $manage_profile->phone=request('phone');
        $manage_profile->address=request('address');
        $manage_profile->country=request('val-skill');
        $manage_profile->city=request('city');
        $manage_profile->postal_code=request('postal_code');
        $manage_profile->apply=2;
        $manage_profile->save();
        session()->flash('success','Application submitted successfully!');
        return back();
    }




















    public function seller_product()
    {
        $category = Category::where('parent_id',NULL)->orderBy('id', 'desc')->get();
        // $sub_category=Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
        $brand = Brand::orderBy('id', 'desc')->get();
        $product=Product::where('product_type','seller')->get();
        return view('supplier.inhouseproduct',compact('category','brand','product'));
    }
    public function seller_product_image_upload(Request $request)
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

    public function seller_product_save(Request $request)
    {
        
        $request->validate([
            'flash_deal' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'special_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'featured_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'uploaded_image_name' => 'required',
            'product_name' => 'required',
            'product_quentity' => 'required',
            'product_category' => 'required',
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
       
        $product->product_type="seller";
        
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

        if ($request->hasFile('special_product')) {
            $logo = $request->file('special_product');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('special_product')->move(public_path('assets/images/product'), $fileName);
            $product->special_product_image=$fileName;
        }

        if ($request->hasFile('featured_product')) {
            $logo = $request->file('featured_product');
            $fileName =time().'.'.$logo->getClientOriginalExtension();
            $path=$request->file('featured_product')->move(public_path('assets/images/product'), $fileName);
            $product->featured_product_image=$fileName;
        }

        $product->video_link=request('video_link');
        $product->added_by=auth()->user()->name;
        $data_choice = [];
        $push="";
        $i=1;
        $content_request="option_content_".$i;
      
        if(!empty($request->option_head) && !empty($request->$content_request))
        {
            foreach($request->option_head as $option_head)
            {
                $content_request="option_content_".$i;
                foreach($request->$content_request as $option_content)
                {
                    $push=$push.','.$option_content;
                }
                $data_choice[$option_head]=trim($push,',');
                $push="";
                $i++;
            }
            $product->customer_choice=serialize($data_choice);
        }
        $product->current_location=request('current_location');
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
        return redirect()->route('seller_product');
        
    }
  
}
