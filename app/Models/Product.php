<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = ['title','price','description','technical_data', 'category', 'discount'];

    public function images() {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function related() {
        return $this->belongsToMany(
            Product::class,
            'product_related',
            'product_id',
            'related_product_id'
        );
    }

    public function relatedByOthers() {
        return $this->belongsToMany(
            Product::class,
            'product_related',
            'related_product_id',
            'product_id'
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->title);
        });

        static::updating(function ($product) {
            if ($product->isDirty('title')) {
                $product->slug = Str::slug($product->title);
            }
        });
    }
}
