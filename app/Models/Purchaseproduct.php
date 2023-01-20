<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchaseproduct extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplierlist::class,'supplierlist_id');
    }

    public function category_name()
    {
        return $this->belongsTo(Category::class,'category');
    }
}
