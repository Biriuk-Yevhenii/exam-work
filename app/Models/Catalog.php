<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Catalog extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['title', 'content', 'category_id', 'price', 'image', 'country_id', 'season_id', 'gender', 'gallery'];
    
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function buys()
    {
        return $this->hasMany(Buy::class);
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? $value : '/image/no_image.png',
        );
    }
    protected function galleryImages(): Attribute
    {
        
        return Attribute::make(
            get: fn ($value, array $attributes) => isset( $attributes['gallery']) ? explode(',', $attributes['gallery']) : []
        );
    }
    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => mb_strtoupper(mb_substr($value,0,1)).mb_substr($value,1)
        );
    }

    protected function shortContent(): Attribute
    {
        return Attribute::make(
            //get: fn ($value, array $attributes) => mb_substr($attributes['content'],0,50)
            get: fn ($value, array $attributes) => Str::words(strip_tags($attributes['content']),7)
        );
    }
    protected function shortTitle(): Attribute
    {
        return Attribute::make(
            //get: fn ($value, array $attributes) => mb_substr($attributes['title'],0,20)
            get: fn ($value, array $attributes) => Str::words(strip_tags($attributes['title']),2)
        );
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
