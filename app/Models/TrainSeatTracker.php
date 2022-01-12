<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainSeatTracker extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'train_seat_trackers';

    public function trainseat()
    {
        return $this->belongsTo(TrainSeat::class , 'train_seat_id');
    }




}
