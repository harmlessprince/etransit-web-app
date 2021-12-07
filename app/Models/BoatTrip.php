<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatTrip extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'departure_date' => 'date',
        'departure_time' => 'datetime',
    ];


    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function cruiselocation()
    {
        return $this->belongsTo(CruiseDestination::class , 'cruise_destination_id');
    }
}
