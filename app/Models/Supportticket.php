<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supportticket extends Model
{
    protected $guarded = [];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function supportticketreply()
    {
        return $this->hasMany(Supportticketreply::class);
    }
}
