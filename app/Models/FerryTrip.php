<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryTrip extends Model
{
    use HasFactory;
    protected  $guarded = ['id'];


    public function ferry()
    {
        return $this->belongsTo(Ferry::class);
    }

    public function destination()
    {
        return $this->belongsTo(FerryLocation::class , 'ferry_destination_id');
    }


    public function pickup()
    {
        return $this->belongsTo(FerryLocation::class , 'ferry_pick_up_id');
    }
}
