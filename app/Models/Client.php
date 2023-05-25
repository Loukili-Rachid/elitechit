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
        'is_email_verified'
    ];


    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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
