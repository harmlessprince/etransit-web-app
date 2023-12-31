<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPlan extends Model
{
    use HasFactory;
    protected $table = 'car_plans';
    protected $guarded = ['id'];
    protected $fillable = ['plan', 'amount'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function carhistory()
    {
        return $this->belongsTo(CarHistory::class);
    }


}
