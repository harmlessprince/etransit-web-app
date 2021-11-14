<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
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

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function pickup()
    {
        return $this->belongsTo(Destination::class , 'pickup_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class , 'service_id');
    }

    public function seatTracker()
    {
        return $this->belongsTo(SeatTracker::class);
    }


}
