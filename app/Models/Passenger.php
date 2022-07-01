<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function onsite_customer(){
        return $this->belongsTo(OnsiteCustomer::class,'onsite_customer_id', 'id');
    }

    public function seat_position()
    {
        return $this->belongsTo(SeatTracker::class , 'seat_tracker_id','id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class );
    }
}
