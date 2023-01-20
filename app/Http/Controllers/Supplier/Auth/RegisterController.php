<?php

namespace App\Http\Controllers\Supplier\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifySupplierRegistration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Supplier;
class RegisterController extends Controller
{
    use RegistersUsers;
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        return view('supplier.auth.register');
    }
   

    protected function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email'=>'required|email|unique:suppliers',
            'phone' => 'required',
            'address' => ['required','string'],
            'password'=>'required|min:5'
        ]);

        $user= Supplier::create([
            // 'code'=>rand(100000,999999),
            'name' => $request->name,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'address' =>$request->address,
            'password' => Hash::make($request->password),
            'remember_token'=>Str::random(40),
            'ip_address'=>request()->ip(),
            'remember_token'=>Str::random(40),
            'role'=>0,  
            'status'=>0, 
        ]);
        $user->notify(new VerifySupplierRegistration($user));
        session()->flash('success','A confirmation message sent to your email');
        return redirect()->route('supplier_register');
    }
}
