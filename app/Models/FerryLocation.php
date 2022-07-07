<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryLocation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'event_date' => 'datetime:Y-m-d',
        'event_time' => 'datetime:h:i:s',
    ];

    public function trips()
    {
        return $this->hasMany(FerryTrip::class);
    }
}
