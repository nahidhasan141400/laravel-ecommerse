<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function productimage()
    {
        return $this->hasOne(Productimage::class,'product_id');
    }

    public function productallimage()
    {
        return $this->hasMany(Productimage::class,'product_id');
    }
    public function productcategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function productchildcategory()
    {
        return $this->belongsTo(Category::class,'childcategory_id');
    }
    public function productbrand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

}
