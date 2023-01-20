<?php

namespace App\Http\Middleware;
use App\Models\Admin;
use Closure;

class LockScreen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $check=Admin::find(auth()->user()->id);
        if($check->status!=2)
        {
            return $next($request);
        }else{
            return redirect()->route('admin_lock_screen');
        }
        
    }
}
