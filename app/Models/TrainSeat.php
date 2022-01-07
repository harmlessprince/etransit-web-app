<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainSeat extends Model
{
    use HasFactory;

    public function train()
    {
        return $this->belongsTo(Train::class);
    }

    public function trainclass()
    {
        return $this->belongsTo(TrainClass::class , 'class_id');
    }

    public function seattrakers()
    {
        return $this->hasMany(TrainSeatTracker::class);
    }
}
