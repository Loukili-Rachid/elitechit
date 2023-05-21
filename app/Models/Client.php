<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Laravel\Cashier\Billable;

class Client extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait,Billable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status_id',
    ];


    protected $hidden = [
        'password',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
