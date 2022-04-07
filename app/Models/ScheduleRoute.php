<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleRoute extends Model
{
    use HasFactory;

    public function trainschedule()
    {
        return $this->belongsTo(TrainSchedule::class , 'train_schedule_id');
    }

//    public function trainRoutes()
//    {
//        return $this->belongsTo(TrainStop::class , 'train_stop_id');
//    }

    public function routeFare()
    {
        return $this->belongsTo(RouteFare::class , 'route_fare_id');
    }
}
