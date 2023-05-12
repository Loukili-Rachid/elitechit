<?php

namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   use Translatable;
    use HasFactory;

    public function Category()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
}
