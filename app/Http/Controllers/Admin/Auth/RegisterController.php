<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifyAdminRegistration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin;
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
        return view('admin.auth.register');
    }
   

    protected function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:8'
        ]);

        $user= Admin::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'remember_token'=>Str::random(40),
            'ip_address'=>request()->ip(),
            'remember_token'=>Str::random(40),
            'role'=>0,  
            'status'=>0, 
        ]);
        $user->notify(new VerifyAdminRegistration($user));
        session()->flash('success','A confirmation message sent to your email');
        return redirect()->route('admin_register');
    }
}
