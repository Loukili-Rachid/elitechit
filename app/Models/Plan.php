<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function options()
    {
        return $this->hasMany(Option::class, 'plan_id', 'id');
    }
}
