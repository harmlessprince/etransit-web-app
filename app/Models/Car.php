<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function plans()
    {
        return $this->HasMany(CarPlan::class );
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function cartype()
    {
        return $this->belongsTo(CarType::class , 'car_type_id');
    }

    public function carclass()
    {
        return $this->belongsTo(CarClass::class, 'car_class_id');
    }

    public function car_images()
    {
        return $this->hasMany(CarImage::class);
    }

}
