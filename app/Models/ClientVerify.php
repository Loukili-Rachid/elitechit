<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientVerify extends Model
{
    use HasFactory;

    public $table = "clients_verify";
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'client_id',
        'token',
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
