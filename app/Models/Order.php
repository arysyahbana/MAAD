<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function rUser()
    {
        return $this->belongsTo(User::class);
    }

    public function rPrice()
    {
        return $this->belongsTo(Price::class);
    }
}
