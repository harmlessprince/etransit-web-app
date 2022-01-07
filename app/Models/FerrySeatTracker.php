<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerrySeatTracker extends Model
{
    use HasFactory;
    protected  $guarded = ['id'];

    public function ferryseat()
    {
        return $this->belongsTo(FerrySeat::class , 'ferry_seat_id');
    }
}
