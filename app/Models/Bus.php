<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = [
        'bus_type',
        'bus_model',
        'tenant_id',
        'driver_id',
        'service_id',
        'bus_registration',
        'air_conditioning',
        'wheels',
        'seater',
        'bus_year',
        'bus_colour',
        'bus_available_seats',
        'bus_pictures',
        'bus_proof_of_ownership',
    ];

    protected $appends = [
        'bus_unavailable_seats',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope);
    }

    public function getBusUnavailableSeatsAttribute()
    {
        return (int)$this->seater - (int)$this->bus_available_seats;
    }

    public function getBusPicturesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getBusProofOfOwnershipAttribute($value)
    {
        return json_decode($value, true);
    }
}
