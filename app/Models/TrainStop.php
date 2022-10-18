<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainStop extends Model
{
    use HasFactory ,SoftDeletes;

    protected $guarded = ['id'];

    public function state()
    {
        return $this->belongsTo(TrainLocation::class , 'train_location_id');
    }

    public function class()
    {
        return $this->belongsTo(TrainClass::class , 'train_class_id');
    }
}
