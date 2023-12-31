<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerrySeat extends Model
{
    use HasFactory;

    public function seattracker()
    {
        return $this->hasMany(FerrySeatTracker::class);
    }
}
