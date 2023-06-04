<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['catalog_id', 'size'];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, );
    }
    
}
