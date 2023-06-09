<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref',
        'price',
        'label',
        'description',
        'body',
        'brand',
        'cost',
        'image',
        'discount',
        'meta_description',
        'meta_title',
        'meta_keywords',
        'category_product_id',
        'status_id',
    ];

    public function category() 
    {
        return $this->belongsTo(CategoryProduct::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function status()
    {
        return $this->belongsTo(Status::class)->where('model', class_basename(self::class));
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->ref = '#'.Str::random(10). date('YmdHi');
        });
    }
}
