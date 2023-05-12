<?php

namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    use Translatable;
    protected $timestamp = false;
    public function items()
    {
        return $this->hasMany(FooterItem::class, 'footer_id', 'id')->orderBy('order', 'ASC');
    }
}
