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
}
