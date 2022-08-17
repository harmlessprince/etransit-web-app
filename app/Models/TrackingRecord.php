<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingRecord extends Model
{
    use HasFactory;

    protected $table = 'tracking_records';
    protected $guarded = ['id'];
}
