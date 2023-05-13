<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'label',
        'description',
        'brand',
        'cost',
        'category_product_id',
        'status_id',
    ];

    public function category() 
    {
        return $this->belongsTo(CategoryProduct::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details','product_id','order_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
