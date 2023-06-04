<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $fillable = ['country', 'sity', 'post_code', 'address', 'name','sec_name', 'tel', 'email', 'cart_id', 'payment', 'user_id', 'order_id'];

    public function catalog(){
        return $this->belongsTo(Catalog::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
