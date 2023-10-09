<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        'terminal_id',
        'tenant_id',
        'service_id',
        'bus_id',
        'pickup_id',
        'destination_id',
        'fare_adult',
        'fare_children',
        'departure_date',
        'return_date',
        'departure_time',
        'return_time',
        'return_uuid_tracker',
        'isReturn',
        'trip_status',
        'seats_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'departure_date' => 'datetime:Y-m-d',
        'return_date' => 'datetime:Y-m-d',
    ];

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }

    public function pickup()
    {
        return $this->belongsTo(Destination::class, 'pickup_id', 'id');
//        return $this->belongsTo(Pickup::class, 'pickup_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function seatTracker()
    {
        return $this->belongsTo(SeatTracker::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);
    }

}
