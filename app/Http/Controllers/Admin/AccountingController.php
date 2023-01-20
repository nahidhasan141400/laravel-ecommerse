<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\Dealerprice;
use App\Models\Bankcheque;
use App\Models\Product;
use App\Models\Cart;

class AccountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   

}
