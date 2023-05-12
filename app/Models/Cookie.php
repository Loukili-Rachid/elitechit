<?php

namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    use HasFactory;
    use Translatable;
    protected $timestamp = false;
    protected $fillable = ['read_more', 'title', 'body', 'msg'];
}
