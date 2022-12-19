<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Tracker extends Model
{
    use HasFactory, UUID;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tracking_details()
    {
        return $this->hasOne(TrackingRecord::class);
    }
}
