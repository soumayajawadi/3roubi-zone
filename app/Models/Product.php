<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'name_ar', 'slug', 'short_description', 'description',
        'description_ar', 'price', 'weight', 'stock', 'category_id',
        'image', 'shipping_countries', 'archived_at'
    ];

    protected $casts = [
        'archived_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeActive($query)
    {
        return $query->whereNull('archived_at');
    }

    public function getImageSrcAttribute()
    {
        $img = $this->attributes['image'] ?? null;

        if (!$img) {
            return null;
        }

        return str_starts_with($img, 'http')
            ? $img
            : asset('storage/' . $img);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}