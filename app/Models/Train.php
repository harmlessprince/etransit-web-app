<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    public function trainseats()
    {
        return $this->hasMany(TrainSeat::class );
    }

    public function trainschedule()
    {
        return $this->belongsTo(TrainSchedule::class);
    }




}
