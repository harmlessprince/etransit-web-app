<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryParcel extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function delivery_state()
    {
        return $this->belongsTo(State::class , 'delivery_state_id');
    }

    public function delivery_city()
    {
        return $this->belongsTo(City::class ,'delivery_city_id');
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
