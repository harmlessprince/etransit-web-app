<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteFare extends Model
{
    use HasFactory;

    protected $table = 'route_fare';

    public function city()
    {
        return $this->belongsTo(TrainLocation::class , 'train_location_id');
    }

    public function terminal()
    {
        return $this->belongsTo(TrainStop::class , 'train_stop_id');
    }

    public function seatClass()
    {
        return $this->belongsTo(TrainClass::class , 'train_class_id');
    }
}
