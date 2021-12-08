<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }


}
