<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'departure_date' => 'datetime',
    ];


    public function destination()
    {
        return $this->belongsTo(TrainLocation::class , 'destination_id');
    }

    public function pickup()
    {
        return $this->belongsTo(TrainLocation::class , 'pickup_id');
    }

    public function train()
    {
        return $this->belongsTo(Train::class );
    }
}
