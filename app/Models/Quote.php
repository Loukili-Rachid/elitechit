<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['name','email','phone','subject','job','message'];
    use HasFactory;
}
