<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'returnDate' => 'date',
        'time' => 'datetime',
        'returnTime' => 'datetime',

    ];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function carplan()
    {
        return $this->belongsTo(CarPlan::class ,'car_plan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class );
    }
}
