<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
            // $check=Adminuser::find(auth()->user()->id);
            // if($check->status==2)
            // {
            //     return redirect()->route('admin_lock_screen');
            // }else{
                
            // }
        }
        else if (Auth::guard('supplier')->check()) {
            return redirect('/be/welcome/dashboard');
        }
        else if (Auth::guard('customer')->check()) {
            return redirect('/customer/welcome/dashboard');
        }
        
        return $next($request);
    }
}
