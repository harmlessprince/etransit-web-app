<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EticketPasswordRequest extends Model
{
    use HasFactory;
    protected $fillable = ['eticket_id', 'new_password', 'admin_approval'];


    public function eticket()
    {
        return $this->belongsTo(Eticket::class);
    }
}
