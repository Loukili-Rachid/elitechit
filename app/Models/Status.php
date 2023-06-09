<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'model'];


    public function scopeProduct($query)
    {
        return $query->where('model', class_basename(Product::class));
    }

    public function scopeClient($query)
    {
        return $query->where('model', class_basename(Client::class));
    }

    public function scopeOrder($query)
    {
        return $query->where('model', class_basename(Order::class));
    }
}
