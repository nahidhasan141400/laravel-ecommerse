<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Compare extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function totalCompareIteams()
    {
        
        if(Auth::guard('supplier')->check())
        {
            $compares=Compare::where('user_id',Auth::guard('supplier')->id())
                    ->orWhere('ip',request()->ip())
                    ->get();
        }else{
            $compares=Compare::where('ip',request()->ip())
                    ->get();
        }
        $total_iteams=0;
        foreach($compares as $compare)
        {
            $total_iteams++;
        }
        return $total_iteams;
    }

    public static function totalCompare()
    {
        if(Auth::guard('supplier')->check())
        {
            $compare=Compare::where('user_id',Auth::guard('supplier')->id())
                    ->orWhere('ip',request()->ip())
                    ->get();
        }else{
            $compare=Compare::where('ip',request()->ip())
                    ->get();
        }
        return $compare;
    }
}
