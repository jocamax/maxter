<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title','price','description','technical_data', 'category'];

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
}
