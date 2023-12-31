<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CruiseDestination extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function boattrip()
    {
        return $this->hasMany(BoatTrip::class);
    }
}
