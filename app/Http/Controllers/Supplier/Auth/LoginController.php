<?php

namespace App\Http\Controllers\Supplier\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Supplier;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;
    protected $redirectTo = 'supplier/welcome/dashboard';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:supplier')->except('logout');
    }
    public function showLoginForm()
    {
        return view('supplier.auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        $user=Supplier::where('email',$request->email)->first();
        if(!is_null($user) && $user->status==1 && $user->role==0)
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
            return redirect()->route('supplier_login');
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
            return redirect()->route('supplier_login');
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended('/be/welcome/dashboard');
    }
    protected function authenticated(Request $request, $user)
    {
        //
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('supplier_login');
    }

    protected function loggedOut(Request $request)
    {
        //
    }
    protected function guard()
    {
        return Auth::guard('supplier');
    }
}
