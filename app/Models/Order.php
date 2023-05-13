<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'profit',
        'client_id',
        'status_id',
    ];

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details','product_id','order_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
