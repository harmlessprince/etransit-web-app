<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainLocation extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'train_locations';

    protected $guarded = ['id'];

    public function routes()
    {
        return $this->hasMany(TrainLocation::class );
    }
}
