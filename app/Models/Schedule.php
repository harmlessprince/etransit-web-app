<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

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
        return $this->belongsTo(Bus::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class , 'service_id');
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
