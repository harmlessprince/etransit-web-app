<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryLocation extends Model
{
    use HasFactory;

    public function trips()
    {
        return $this->hasMany(FerryTrip::class);
    }
}
