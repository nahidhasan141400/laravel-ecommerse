<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\userlog;
class LoginController extends Controller
{
    
    use AuthenticatesUsers;
    protected $redirectTo = 'admin/welcome/dashboard';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:supplier')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
         
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        $user=Admin::where('email',$request->email)->first();
        if(is_null($user))
        {
            $user_role="unknown";
        }else{
            if($user->status==2)
            {
                $user->status=1;
                $user->save();
            }
            $user_role=$user->role;
        }
        userlog::create([
            'email'=>$request->email,
            'role'=>$user_role,
            'user_agent'=>$request->server('HTTP_USER_AGENT'),
            'ip'=>request()->ip(),
        ]);

        if(!is_null($user) && $user->status==1 && $user->role!=0)
        {
            if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
            }
            if ($this->guard()->attempt(
                $request->only('email', 'password'), $request->filled('remember'))) {
                return $this->sendLoginResponse($request);
            }
            $this->incrementLoginAttempts($request);

            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }else if(!is_null($user))
        {
            session()->flash('success','Please verify your email.');
            if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
            }
            $this->incrementLoginAttempts($request);

            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
            return redirect()->route('admin_login');
        }else{
            if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
            }
            $this->incrementLoginAttempts($request);

            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
            return redirect()->route('admin_login');
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }
    protected function authenticated(Request $request, $user)
    {
        //
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('admin_login');
    }

    protected function loggedOut(Request $request)
    {
        //
    }
    protected function guard()
    {
        return Auth::guard();
    }
}
