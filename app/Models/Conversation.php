<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
