<?php

namespace App\Http\Controllers\Supplier\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\Models\Supplier;
class VerificationController extends Controller
{
    public function verify($token)
    {
        $user=Supplier::where('remember_token',$token)->first();
        if(!is_null($user))
        {
            $user->status=1;
            $user->remember_token=NULL;
            $user->save();
            session()->flash('success','You are registered');
            return redirect()->route('supplier_login');
        }
        else{
            session()->flash('error','Error Verification');
            return redirect()->route('supplier_register');
        }
    }
}
