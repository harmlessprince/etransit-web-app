<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ferry extends Model
{
    use HasFactory;

    public function ferrytype()
    {
        return $this->belongsTo(FerryType::class ,'ferry_type_id');
    }

    public function trips()
    {
        return $this->hasMany(FerryTrip::class);
    }

    public function images()
    {
        return $this->hasMany(FerryImage::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function pickup()
    {
        return $this->belongsTo(FerryLocation::class ,'ferry_pick_up_id','id');
    }

    public function destination()
    {
        return $this->belongsTo(FerryLocation::class ,'ferry_destination_id','id');
    }
}
