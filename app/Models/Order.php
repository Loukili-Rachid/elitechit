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
        'first_name',
        'last_name',
        'phone',
        'address_one',
        'address_two',
        'country',
        'state',
        'zip_code',
        'city',
    ];

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class)->where('model', class_basename(self::class));
    }
}
