<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'comment', 'catalog_id', 'rating'];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
    protected function shortComment(): Attribute
    {
        return Attribute::make(
            //get: fn ($value, array $attributes) => mb_substr($attributes['content'], 0, 20)
            get: fn ($value, array $attributes) => Str::words(strip_tags($attributes['comment']), 4)
        );
    }
}
