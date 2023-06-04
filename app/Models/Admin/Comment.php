<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'comment', 'catalog_id'];
    protected function shortComment(): Attribute
    {
        return Attribute::make(
            //get: fn ($value, array $attributes) => mb_substr($attributes['content'], 0, 20)
            get: fn ($value, array $attributes) => Str::words(strip_tags($attributes['comment']), 4)
        );
    }
}
