<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function boatimages()
    {
        return $this->hasMany(BoatImage::class );
    }

    public function trips()
    {
        return $this->hasMany(BoatTrip::class);
    }


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
