<?php

namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterItem extends Model
{
    use HasFactory;
    use Translatable;
    protected $timestamp = false;
    public function footer()
    {
        return $this->belongsTo(Footer::class, 'footer_id', 'id')->orderBy('order', 'ASC');
    }
}
