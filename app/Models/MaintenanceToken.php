<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MaintenanceToken extends Model
{
    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
