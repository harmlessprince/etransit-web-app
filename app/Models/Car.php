<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $fillable = ['car_name', 'car_class_id', 'car_type_id', 'description', 'capacity', 'car_registration', 'model_year', 'transmission', 'state_id', 'self_drive'];

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

    public function state()
    {
        return $this->belongsTo(Destination::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function carHistory()
    {
        return $this->HasMany(CarHistory::class);
    }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    // protected static function booted()
    // {
    //     static::addGlobalScope(new TenantScope);
    // }

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->whereNull('deleted_at');
    }


}
