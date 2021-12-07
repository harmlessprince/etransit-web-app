<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tour_date' => 'date',
        'tour_time' => 'datetime',
    ];

    public function tourimages()
    {
        return $this->hasMany(TourImage::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
