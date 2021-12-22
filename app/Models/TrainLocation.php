<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainLocation extends Model
{
    use HasFactory;
    protected $table = 'train_locations';

    public function routes()
    {
        return $this->hasMany(TrainLocation::class );
    }
}
